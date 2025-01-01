<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcClient;
use Override;

use function explode;
use function substr;

class KickMessage extends IrcMessage
{
    public string $message;
    public string $kicker;
    public string $user;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        [$this->kicker] = explode(' ', $command);
        [$this->kicker] = explode('!', $this->kicker);
        $this->kicker = substr($this->kicker, 1);

        [$this->target, $this->user] = explode(' ', $this->commandsuffix ?? '');
        $this->message = $this->payload;
    }

    /**
     * When the bot is kicked form a channel, it might need to auto-rejoin.
     */
    #[Override]
    public function handle(IrcClient $client, bool $force = false): void
    {
        if ($this->handled && !$force) {
            return;
        }

        if ($client->getNickname() === $this->user && $client->shouldAutoRejoin()) {
            $client->join($this->target);
            $this->handled = true;
        }
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event(
                'kick',
                [$this->channel, $this->user, $this->kicker, $this->message]
            ),
        ];
    }
}
