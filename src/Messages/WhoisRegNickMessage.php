<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Override;

use function explode;

class WhoisRegNickMessage extends IrcMessage
{
    public string $user;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        [, , , $this->user] = explode(' ', $command);
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('nick-is-registered', [$this->user]),
        ];
    }
}
