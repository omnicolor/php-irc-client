<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use RuntimeException;

use function count;

/**
 * The EXTBAN parameter indicates the types of “extended ban masks” that the
 * server supports.
 *
 * <prefix> denotes the character that indicates an extban to the server and
 * <types> is a list of characters indicating the types of extended bans the
 * server supports. If <prefix> does not exist then the server does not require
 * a prefix for extbans, and they should be sent with no prefix.
 *
 * Extbans may allow clients to issue bans based on account name, SSL
 * certificate fingerprints and other attributes, based on what the server
 * supports.
 *
 * Extban masks SHOULD also be supported for the ban exception and invite
 * exception modes.
 */
class ExtendedBanMasks extends Feature
{
    public readonly string $prefix;
    /** @var array<int, string> */
    public readonly array $types;

    public function __construct(array $values)
    {
        if (2 > count($values)) {
            throw new RuntimeException(
                'Too few parameters for extended ban masks'
            );
        }

        [$this->prefix, $types] = $values;
        if (1 < mb_strlen($this->prefix)) {
            throw new RuntimeException(
                'Prefix must be at most a single character'
            );
        }

        $this->types = mb_str_split($types);
    }
}
