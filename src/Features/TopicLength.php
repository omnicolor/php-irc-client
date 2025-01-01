<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The TOPICLEN parameter indicates the maximum length of a topic that a client
 * may set on a channel. Channels on the network MAY have topics with longer
 * lengths than this.
 *
 * The value MUST be specified and MUST be a positive integer. 307 is the
 * typical value for this parameter advertised by servers today.
 */
class TopicLength extends NumericFeature implements Stringable
{
}
