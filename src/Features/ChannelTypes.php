<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

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
class ChannelTypes extends Feature
{
    /** @var array<int, string> */
    public readonly array $types;

    public function __construct(string $value)
    {
        $this->types = mb_str_split($value);
    }
}
