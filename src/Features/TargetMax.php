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
use function explode;
use function is_array;
use function is_numeric;
use function is_string;

/**
 * Certain client commands MAY contain multiple targets, delimited by a comma
 * (',', 0x2C). The TARGMAX parameter defines the maximum number of targets
 * allowed for commands which accept multiple targets. If this parameter is not
 * advertised or a value is not sent then a client SHOULD assume that no
 * commands except the JOIN and PART commands accept multiple parameters.
 *
 * The value is OPTIONAL and is a set of <command>:<limit> pairs, delimited by
 * a comma (',', 0x2C). <command> is the name of a client command. <limit> is
 * the maximum number of targets which that command accepts. If <limit> is
 * specified, it is a positive integer. If <limit> is not specified, then there
 * is no maximum number of targets for that command. Clients MUST treat
 * <command> as case-insensitive.
 *
 * Example: TARGMAX=PRIVMSG:3,WHOIS:1,JOIN:
 */
class TargetMax extends Feature implements ArrayAccess, Countable
{
    /** @var array<string, int|null> */
    public readonly array $commands;

    public function __construct(array|string $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        $commands = [];
        foreach ($value as $limit) {
            [$command, $limit] = array_merge(
                explode(':', $limit),
                [1 => null],
            );

            if ('' === $limit) {
                $commands[$command] = null;
                continue;
            }

            if (!is_numeric($limit)) {
                throw new RuntimeException('Value must be an integer');
            }

            if (0 >= $limit) {
                throw new RuntimeException('Value must be positive');
            }
            $commands[$command] = (int)$limit;
        }
        $this->commands = $commands;
    }

    #[Override]
    public function count(): int
    {
        return count($this->commands ?? []);
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return is_string($offset);
    }

    #[Override]
    public function offsetGet(mixed $offset): int|null
    {
        if (isset($this->commands[$offset])) {
            return $this->commands[$offset];
        }

        return null;
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new LogicException('TargetMax is readonly');
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new LogicException('TargetMax is readonly');
    }
}
