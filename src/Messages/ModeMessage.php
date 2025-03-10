<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcChannel;
use Override;

use function explode;
use function str_starts_with;

class ModeMessage extends IrcMessage
{
    public string $mode;
    public ?string $target = null;
    public string $user;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        if (str_starts_with($this->commandsuffix, '#')) {
            [$this->target, $this->mode] = explode(' ', $this->commandsuffix);
            $this->user = $this->payload;
            $this->channel = new IrcChannel($this->target);
        } else {
            $this->user = $this->commandsuffix;
            $this->mode = $this->payload;
        }
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('mode', [$this->channel, $this->user, $this->mode]),
        ];
    }
}
