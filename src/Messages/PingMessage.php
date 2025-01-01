<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcClient;
use Override;

class PingMessage extends IrcMessage
{
    /**
     * Reply the ping message with a pong response.
     */
    public function handle(IrcClient $client, bool $force = false): void
    {
        if ($this->handled && !$force) {
            return;
        }

        $client->send("PONG :$this->payload");
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('ping'),
        ];
    }
}
