<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The NICKLEN parameter indicates the maximum length of a nickname that a
 * client may set. Clients on the network MAY have longer nicks than this.
 *
 * The value MUST be specified and MUST be a positive integer. 30 or 31 are
 * typical values for this parameter advertised by servers today.
 */
class NicknameLength extends NumericFeature implements Stringable
{
}
