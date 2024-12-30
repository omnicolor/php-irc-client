<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

/**
 * The CASEMAPPING parameter indicates what method the server uses to compare
 * equality of case-insensitive strings (such as channel names and nicks).
 *
 * The value MUST be specified and MUST be a string representing the method
 * that the server uses.
 *
 * The specified casemappings are as follows:
 * - ascii: Defines the characters a to z to be considered the lower-case
 *   equivalents of the characters A to Z only.
 * - rfc1459: Same as 'ascii', with the addition of the characters '{', '}',
 *   '|', and '^' being considered the lower-case equivalents of the characters
 *   '[', ']', '\', and '~' respectively.
 * - rfc1459-strict: Same casemapping as 'ascii', with the characters '{', '}',
 *   and '|' being the lower-case equivalents of '[', ']', and '\',
 *   respectively. Note that the difference between this and rfc1459 above
 *   is that in rfc1459-strict, '^' and '~' are not casefolded.
 * - rfc7613: Proposed casemapping which defines a method based on PRECIS,
 *   allowing additional Unicode characters to be correctly casemapped.
 *
 * The value MUST be specified and is a string. Servers MAY advertise alternate
 * casemappings to those above, but clients MAY NOT be able to understand or
 * perform them. If the parameter is not published by the server at all,
 * clients SHOULD assume CASEMAPPING=rfc1459.
 *
 * Servers SHOULD AVOID using the rfc1459 casemapping unless explicitly
 * required for compatibility reasons or for linking with servers using it. The
 * equivalency of the extra characters is not necessary nor useful today, and
 * issues such as incorrect implementations and a conflict between matching
 * masks exists.
 */
class CaseMapping extends Feature implements Stringable
{
    public function __construct(public readonly string $value = 'rfc1459')
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
