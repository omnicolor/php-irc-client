<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * Indicates the maximum number of targets a user may have in their monitor
 * list. If "number" is not specified, there is no limit.
 */
class MonitorListLength extends NumericFeature implements Stringable
{
}
