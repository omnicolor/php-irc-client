<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * Indicates the maximum number of online nicknames a user may have in their
 * accept list.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class AcceptListLength extends NumericFeature implements Stringable
{
}
