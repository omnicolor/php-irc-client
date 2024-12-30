<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The MODES parameter specifies how many ‘variable’ modes may be set on a
 * channel by a single MODE command from a client. A ‘variable’ mode is defined
 * as being a type A, B or C mode as defined in the CHANMODES parameter, or in
 * the channel modes specified in the PREFIX parameter.
 *
 * A client SHOULD NOT issue more ‘variable’ modes than this in a single MODE
 * command. A server MAY however issue more ‘variable’ modes than this in a
 * single MODE message. The value is OPTIONAL and when not specified indicates
 * that there is no limit to the number of ‘variable’ modes that may be set in
 * a single client MODE command. If the parameter is not published by the
 * server at all, clients SHOULD assume MODES=3, corresponding to the RFC1459
 * behavior.
 *
 * If the value is specified, it MUST be a positive integer.
 */
class Modes extends NumericFeature implements Stringable
{
}
