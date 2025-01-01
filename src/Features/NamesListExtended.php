<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

/**
 * Indicates that the "NAMES" reply message may be extended to contain all
 * possible prefixes, which apply to a user. The IRCv3 Working Group recommends
 * that the "multi-prefix" client capability is used instead of this token.
 */
class NamesListExtended extends Feature
{
}
