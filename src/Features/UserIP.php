<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

/**
 * Indicates support for the "USERIP" command, which is used to request the
 * direct IP address of the user with the specified nickname. This might be
 * supported by networks that don’t advertise this token.
 */
class UserIP extends Feature
{
}
