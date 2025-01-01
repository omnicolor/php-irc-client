<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use RuntimeException;

/**
 * Indicates that the "NAMES" reply message may be extended to contain the full
 * hostmask of every user listed. Must NOT have a value. The IRCv3 Working
 * Group recommends that the "userhost-in-names" client capability is used
 * instead of this token.
 */
class NamesReplyContainsHostnames extends Feature
{
    public function __construct(bool|string $value)
    {
        if (true !== $value) {
            throw new RuntimeException('UHNAMES must not have a value');
        }
    }
}
