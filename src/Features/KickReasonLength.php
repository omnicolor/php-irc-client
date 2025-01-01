<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The KICKLEN parameter indicates the maximum length for the <reason> of a
 * KICK command. If a KICK <reason> has more characters than this parameter,
 * it may be silently truncated by the server before being passed on to other
 * clients. Clients MAY receive a KICK <reason> that has more characters than
 * this parameter.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class KickReasonLength extends NumericFeature implements Stringable
{
}
