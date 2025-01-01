<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use RuntimeException;
use Stringable;

/**
 * The EXCEPTS parameter indicates that the server supports ban exceptions, as
 * specified in the ban exception channel mode section.
 *
 * The value is OPTIONAL and when not specified indicates that the letter "e"
 * is used as the channel mode for ban exceptions. If the value is specified,
 * the character indicates the letter which is used for ban exceptions.
 */
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

    #[Override]
    public function __toString(): string
    {
        return $this->letter;
    }
}
