<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The HOSTLEN parameter indicates the maximum length that a hostname may be on
 * the server (whether cloaked, spoofed, or a looked-up domain name). Networks
 * SHOULD be consistent with this value across different servers.
 *
 * If a looked-up domain name is longer than this length, the server SHOULD opt
 * to use the IP address instead, so that the hostname is underneath this
 * length.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class HostnameLength extends NumericFeature implements Stringable
{
}
