<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use ArrayAccess;
use Countable;
use LogicException;
use Override;

use function count;
use function mb_str_split;

/**
 * The CHANTYPES parameter indicates the channel prefix characters that are
 * available on the current server. Common channel types are listed in the
 * Channel Types section.
 *
 * The value is OPTIONAL; if it is not present, it indicates that no channel
 * types are supported. If the parameter is not published by the server at all,
 * clients SHOULD assume CHANTYPES=#&, corresponding to the RFC1459 behavior.
 */
class ChannelTypes extends Feature implements ArrayAccess, Countable
{
    /** @var array<int, string> */
    public readonly array $types;

    public function __construct(string $value)
    {
        $this->types = mb_str_split($value);
    }

    #[Override]
    public function count(): int
    {
        return count($this->types);
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return in_array($offset, $this->types, true);
    }

    #[Override]
    public function offsetGet(mixed $offset): bool
    {
        return in_array($offset, $this->types, true);
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new LogicException('ChannelTypes is readonly');
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new LogicException('ChannelTypes is readonly');
    }
}
