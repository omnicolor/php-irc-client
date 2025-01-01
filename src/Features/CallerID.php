<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use RuntimeException;
use Stringable;

/**
 * CALLERID, also known as usermode g, is another server-side ignore mechanism,
 * via which ALL private messages or notices are blocked unless the user
 * specifically unblocked them through an ACCEPT command. Unlike SILENCE,
 * messages to channels are completely unaffected.
 */
class CallerID extends Feature implements Stringable
{
    public readonly string $letter;

    public function __construct(null|string $letter)
    {
        if (null === $letter) {
            $this->letter = 'g';
            return;
        }

        if (1 !== mb_strlen($letter)) {
            throw new RuntimeException(
                'Caller ID flag must be one character'
            );
        }

        $this->letter = $letter;
    }

    #[Override]
    public function __toString(): string
    {
        return $this->letter;
    }
}
