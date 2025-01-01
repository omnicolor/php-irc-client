<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use RuntimeException;
use Stringable;

/**
 * The INVEX parameter indicates that the server supports invite exceptions, as
 * specified in the invite exception channel mode section.
 *
 * The value is OPTIONAL and when not specified indicates that the letter "I"
 * is used as the channel mode for invite exceptions. If the value is
 * specified, the character indicates the letter which is used for invite
 * exceptions.
 */
class InviteExceptions extends Feature implements Stringable
{
    public readonly string $letter;

    public function __construct(null|string $letter)
    {
        if (null === $letter) {
            $this->letter = 'I';
            return;
        }

        if (1 !== mb_strlen($letter)) {
            throw new RuntimeException(
                'Invite exceptions flag must be one character'
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
