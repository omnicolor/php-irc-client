<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Stringable;

use function str_contains;

/**
 * The ELIST parameter indicates that the server supports search extensions to
 * the LIST command.
 *
 * The value MUST be specified, and is a non-delimited list of letters, each of
 * which denote an extension. The letters MUST be treated as being
 * case-insensitive.
 *
 * The following search extensions are defined:
 * C: Searching based on channel creation time, via the "C<val" and "C>val"
 *    modifiers to search for a channel that was created either less than val
 *    minutes ago, or more than val minutes ago, respectively
 * M: Searching based on a mask.
 * N: Searching based on a non-matching !mask. i.e., the opposite of M.
 * T: Searching based on topic set time, via the "T<val" and "T>val" modifiers
 *    to search for a topic time that was set less than val minutes ago, or
 *    more than val minutes ago, respectively.
 * U: Searching based on user count within the channel, via the "<val" and
 *    ">val" modifiers to search for a channel that has less or more than val
 *    users, respectively.
 */
class ExtendedList extends Feature implements Stringable
{
    public const string SEARCH_CHANNEL_CREATION_TIME = 'C';
    public const string SEARCH_MASK = 'M';
    public const string SEARCH_NON_MATCHING_MASK = 'N';
    public const string SEARCH_TOPIC_SET_TIME = 'T';
    public const string SEARCH_USER_COUNT = 'U';

    public function __construct(public readonly string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function supportsSearchByChannelCreation(): bool
    {
        return str_contains($this->value, self::SEARCH_CHANNEL_CREATION_TIME);
    }

    public function supportsSearchByMask(): bool
    {
        return str_contains($this->value, self::SEARCH_MASK);
    }

    public function supportsSearchByNonMatchingMask(): bool
    {
        return str_contains($this->value, self::SEARCH_NON_MATCHING_MASK);
    }

    public function supportsSearchByTopicSetTime(): bool
    {
        return str_contains($this->value, self::SEARCH_TOPIC_SET_TIME);
    }

    public function supportsSearchByUserCount(): bool
    {
        return str_contains($this->value, self::SEARCH_USER_COUNT);
    }
}
