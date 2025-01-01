<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use RuntimeException;
use Stringable;

/**
 * Indicates the character to be used as a user mode to let clients mark
 * themselves as bots by setting it.
 */
class Bot extends Feature implements Stringable
{
    public readonly string $letter;

    public function __construct(null|string $letter)
    {
        if (null === $letter) {
            $this->letter = 'B';
            return;
        }

        if (1 !== mb_strlen($letter)) {
            throw new RuntimeException(
                'Bot flag must be one character'
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
