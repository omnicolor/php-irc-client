<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The SILENCE parameter indicates the maximum number of entries a client can
 * have in their silence list.
 *
 * The value is OPTIONAL and if specified is a positive integer. If the value
 * is not specified, the server does not support the SILENCE command.
 *
 * Most IRC clients also include client-side filter/ignore lists as an
 * alternative to this command.
 */
class SilenceListLength extends NumericFeature implements Stringable
{
}
