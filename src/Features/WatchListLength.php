<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * WATCH is an extension designed to implement client /notify lists without the
 * need for the client to poll via ISON. When supported by the server, a
 * compatible client will recognize that WATCH is available and use it in place
 * of ISON to stay updated of the status of users on the client’s /notify list.
 *
 * The advantages of this are lowered overhead for the server and more rapid
 * detection of users on the notify list than would be possible via polling.
 */
class WatchListLength extends NumericFeature implements Stringable
{
}
