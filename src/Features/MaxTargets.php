<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The MAXTARGETS parameter specifies the maximum number of targets a PRIVMSG
 * or NOTICE command may have, and may apply to other commands based on server
 * software.
 *
 * The value is OPTIONAL and if specified, [number] is a positive integer
 * representing the maximum number of targets those commands may have. If there
 * is no limit, then [number] MAY not be specified.
 *
 * The TARGMAX parameter SHOULD be advertised instead of or in addition to this
 * parameter. TARGMAX is intended to replace MAXTARGETS as that parameter is
 * more clear about which commands limits apply to.
 * @see TargetMax
 */
class MaxTargets extends NumericFeature implements Stringable
{
}
