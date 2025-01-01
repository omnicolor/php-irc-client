<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The USERLEN parameter indicates the maximum length that a username may be on
 * the server. Networks SHOULD be consistent with this value across different
 * servers. As noted in the USER message, the tilde prefix ("~"), if it exists,
 * contributes to the length of the username and would be included in this
 * parameter.
 *
 * The value MUST be specified and MUST be a positive integer.
 */
class UsernameLength extends NumericFeature implements Stringable
{
}
