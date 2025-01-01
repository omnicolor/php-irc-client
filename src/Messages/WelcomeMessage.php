<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcClient;
use Override;

class WelcomeMessage extends IrcMessage
{
    /**
     * On welcome message, join the selected channels.
     */
    public function handle(IrcClient $client, bool $force = false): void
    {
        if ($this->handled && !$force) {
            return;
        }

        foreach ($client->getChannels() as $channel) {
            $client->join($channel->getName());
        }
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('registered'),
        ];
    }
}
