<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

use Override;
use Stringable;

class IrcUser implements Stringable
{
    public function __construct(public string $nickname)
    {
    }

    #[Override]
    public function __toString(): string
    {
        return $this->nickname;
    }
}
