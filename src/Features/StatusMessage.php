<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The STATUSMSG parameter indicates that the server supports a method for
 * clients to send a message via the PRIVMSG / NOTICE commands to those people
 * on a channel with (one of) the specified channel membership prefixes.
 *
 * The value MUST be specified and MUST be a list of prefixes as specified in
 * the PREFIX parameter. Most servers today advertise every prefix in their
 * PREFIX parameter in STATUSMSG.
 */
class StatusMessage extends Feature implements Stringable
{
    public function __construct(public readonly string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
