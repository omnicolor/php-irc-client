<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

/**
 * Indicates that ban list sizes may vary from channel to channel.
 */
class VaryingListSize extends Feature
{
    public function __construct(public readonly string $modes)
    {
    }
}
