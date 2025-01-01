<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use ArrayAccess;
use Countable;
use LogicException;
use Override;
use RuntimeException;

use function array_merge;
use function count;
use function current;
use function explode;
use function is_array;
use function is_numeric;
use function mb_str_split;
use function mb_strlen;
use function next;

/**
 * The MAXLIST parameter specifies how many “variable” modes of type A that
 * have been defined in the CHANMODES parameter that a client may set in total
 * on a channel.
 *
 * The value MUST be specified and is a list of <modes>:<limit> pairs,
 * delimited by a comma (',', 0x2C). <modes> is a list of type A modes defined
 * in CHANMODES. <limit> is a positive integer specifying the maximum number of
 * entries that all of the modes in <modes>, combined, may set on a channel.
 *
 * A client MUST NOT make any assumptions on how many mode entries may actually
 * exist on any given channel. This limit only applies to the client setting
 * new modes of the given types, and other clients may have different limits.
 */
class MaxList extends Feature implements ArrayAccess, Countable
{
    /** @var array<string, int> */
    public readonly array $limits;

    /**
     * @param array<int, string>|string $values
     */
    public function __construct(array|string $values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }

        $limits = [];
        while ($value = current($values)) {
            [$mode, $limit] = array_merge(
                explode(':', $value),
                [1 => null],
            );
            if (!is_numeric($limit)) {
                throw new RuntimeException('Limit must be an integer');
            }

            $limit = (int)$limit;
            if (1 > $limit) {
                throw new RuntimeException('Limit must be positive');
            }

            if (1 !== mb_strlen($mode)) {
                // Multiple modes, push them on to the end of the array.
                $modes = mb_str_split($mode);
                foreach ($modes as $mode) {
                    $values[] = $mode . ':' . $limit;
                }
                next($values);
                continue;
            }

            $limits[$mode] = $limit;
            next($values);
        }
        $this->limits = $limits;
    }

    #[Override]
    public function count(): int
    {
        return count($this->limits ?? []);
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->limits[$offset]);
    }

    #[Override]
    public function offsetGet(mixed $offset): int|null
    {
        if (!isset($this->limits[$offset])) {
            return null;
        }

        return $this->limits[$offset];
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new LogicException('MaxList is readonly');
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new LogicException('MaxList is readonly');
    }
}
