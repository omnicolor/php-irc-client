<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcChannel;
use Jerodev\PhpIrcClient\IrcClient;
use Override;

use function explode;
use function sprintf;

class NameReplyMessage extends IrcMessage
{
    /** @var array<int, string> */
    public array $names;

    public function __construct(protected string $command)
    {
        parent::__construct($command);
        $this->channel = new IrcChannel(strstr($this->commandsuffix ?? '', '#'));
        $this->names = explode(' ', $this->payload);
    }

    #[Override]
    public function handle(IrcClient $client, bool $force = false): void
    {
        if ($this->handled && !$force) {
            return;
        }

        if (!empty($this->names)) {
            $client->getChannel($this->channel->getName())
                ->setUsers($this->names);
        }
    }

    /**
     * @return array<int, Event>
     */
    #[Override]
    public function getEvents(): array
    {
        return [
            new Event('names', [$this->channel, $this->names]),
            new Event(sprintf('names%s', $this->channel->getName()), [$this->names]),
        ];
    }
}
