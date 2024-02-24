<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcChannel;
use Jerodev\PhpIrcClient\IrcClient;

class NickMessage extends IrcMessage
{
    public string $oldNick;
    public string $newNick;

    public function __construct(string $message)
    {
        parent::__construct($message);
        [$this->oldNick, , $this->newNick] = explode(' ', $message);
        [$this->oldNick] = explode('!', $this->oldNick);
        $this->oldNick = trim($this->oldNick, ':');
        $this->newNick = trim($this->newNick, ":\n\r");
    }

    /**
     * @return array<int, Event>
     */
    public function getEvents(): array
    {
        return [
            new Event(
                'renamed',
                [$this->oldNick, $this->newNick]
            ),
        ];
    }
}
