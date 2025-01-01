<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The CHANNELLEN parameter specifies the maximum length of a channel name that
 * a client may join. A client elsewhere on the network MAY join a channel with
 * a larger name, but network administrators should take care to ensure this
 * value stays consistent across the network.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class ChannelNameLength extends NumericFeature implements Stringable
{
}
