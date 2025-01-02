<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Override;

use function explode;
use function trim;

class NickMessage extends IrcMessage
{
    public string $oldNick;
    public string $newNick;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        [$this->oldNick, , $this->newNick] = explode(' ', $command);
        [$this->oldNick] = explode('!', $this->oldNick);
        $this->oldNick = trim($this->oldNick, ':');
        $this->newNick = trim($this->newNick, ":\n\r");
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('renamed', [$this->oldNick, $this->newNick]),
        ];
    }
}
