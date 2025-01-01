<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Override;

use function strstr;

class PrivmsgMessage extends IrcMessage
{
    public string $message;
    public string $user;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        $this->user = strstr($this->source ?? '', '!', true);
        $this->target = (string)$this->commandsuffix;
        $this->message = $this->payload;
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        if ('#' === $this->target[0]) {
            return [
                new Event('message', [$this->user, $this->channel, $this->message]),
                new Event("message$this->target", [$this->user, $this->channel, $this->message]),
            ];
        }
        return [
            new Event('privmsg', [$this->user, $this->target, $this->message]),
        ];
    }
}
