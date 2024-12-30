<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use RuntimeException;
use Stringable;

class BanExceptions extends Feature implements Stringable
{
    public readonly string $letter;

    public function __construct(null|string $letter)
    {
        if (null === $letter) {
            $this->letter = 'e';
            return;
        }

        if (1 !== mb_strlen($letter)) {
            throw new RuntimeException(
                'Ban exceptions flag must be one character'
            );
        }

        $this->letter = $letter;
    }

    public function __toString(): string
    {
        return $this->letter;
    }
}
