<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The AWAYLEN parameter indicates the maximum length for the <reason> of an
 * AWAY command. If an AWAY <reason> has more characters than this parameter,
 * it may be silently truncated by the server before being passed on to other
 * clients. Clients MAY receive an AWAY <reason> that has more characters than
 * this parameter.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class AwayMessageLength extends NumericFeature implements Stringable
{
}
