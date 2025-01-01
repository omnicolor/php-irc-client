<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * Indicates that “secure listing” is enabled and that your initial request for
 * a channel list on connect may be denied until you have been connected for a
 * certain amount of time.
 */
class SecureListTime extends NumericFeature implements Stringable
{
}
