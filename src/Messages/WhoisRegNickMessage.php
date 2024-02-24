<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcChannel;
use Jerodev\PhpIrcClient\IrcClient;

class WhoisRegNickMessage extends IrcMessage
{
    public string $user;

    public function __construct(string $message)
    {
        parent::__construct($message);
        [, , , $this->user] = explode(' ', $message);
    }

    /**
     * @return array<int, Event>
     */
    public function getEvents(): array
    {
        return [
            new Event('nick-is-registered', [$this->user]),
        ];
    }
}
