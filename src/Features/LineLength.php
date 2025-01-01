<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * Indicates the maximum allowed length of a single IRC message (line) in
 * octets. The "LINELEN" token defaults to 512.
 */
class LineLength extends NumericFeature implements Stringable
{
}
