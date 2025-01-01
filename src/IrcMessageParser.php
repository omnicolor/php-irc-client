<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

use Generator;
use Jerodev\PhpIrcClient\Messages\ISupportMessage;
use Jerodev\PhpIrcClient\Messages\InviteMessage;
use Jerodev\PhpIrcClient\Messages\IrcMessage;
use Jerodev\PhpIrcClient\Messages\KickMessage;
use Jerodev\PhpIrcClient\Messages\MOTDMessage;
use Jerodev\PhpIrcClient\Messages\ModeMessage;
use Jerodev\PhpIrcClient\Messages\NameReplyMessage;
use Jerodev\PhpIrcClient\Messages\NickMessage;
use Jerodev\PhpIrcClient\Messages\PingMessage;
use Jerodev\PhpIrcClient\Messages\PrivmsgMessage;
use Jerodev\PhpIrcClient\Messages\TopicChangeMessage;
use Jerodev\PhpIrcClient\Messages\WelcomeMessage;
use Jerodev\PhpIrcClient\Messages\WhoisRegNickMessage;

use function explode;
use function str_contains;
use function str_starts_with;
use function strstr;
use function trim;

class IrcMessageParser
{
    /**
     * Parse one or more IRC messages.
     * @return Generator<IrcMessage>
     */
    public function parse(string $message): Generator
    {
        foreach (explode("\n", $message) as $msg) {
            if ('' === trim($msg)) {
                continue;
            }

            yield $this->parseSingle($msg);
        }
    }

    /**
     * Parse a single message to a corresponding object.
     */
    private function parseSingle(string $message): IrcMessage
    {
        return match ($this->getCommand($message)) {
            'KICK' => new KickMessage($message),
            'PING' => new PingMessage($message),
            'PRIVMSG' => new PrivmsgMessage($message),
            IrcCommand::RPL_WELCOME->value => new WelcomeMessage($message),
            'TOPIC', IrcCommand::RPL_TOPIC->value => new TopicChangeMessage($message),
            IrcCommand::RPL_NAMREPLY->value => new NameReplyMessage($message),
            IrcCommand::RPL_MOTD->value => new MOTDMessage($message),
            'MODE' => new ModeMessage($message),
            'NICK' => new NickMessage($message),
            'INVITE' => new InviteMessage($message),
            IrcCommand::RPL_WHOISREGNICK_MSG->value => new WhoisRegNickMessage($message),
            IrcCommand::RPL_ISUPPORT->value => new ISupportMessage($message),
            default => new IrcMessage($message),
        };
    }

    /**
     * Get the COMMAND part of an IRC message.
     */
    private function getCommand(string $message): bool|string
    {
        if (str_starts_with($message, ':') && str_contains($message, ' ')) {
            $message = trim(strstr($message, ' '));
        }

        return strstr($message, ' ', true);
    }
}
