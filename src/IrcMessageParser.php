<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

use Generator;
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
        switch ($this->getCommand($message)) {
            case 'KICK':
                return new KickMessage($message);
            case 'PING':
                return new PingMessage($message);
            case 'PRIVMSG':
                return new PrivmsgMessage($message);
            case IrcCommand::RPL_WELCOME->value:
                return new WelcomeMessage($message);
            case 'TOPIC':
            case IrcCommand::RPL_TOPIC->value:
                return new TopicChangeMessage($message);
            case IrcCommand::RPL_NAMREPLY->value:
                return new NameReplyMessage($message);
            case IrcCommand::RPL_MOTD->value:
                return new MOTDMessage($message);
            case 'MODE':
                return new ModeMessage($message);
            case 'NICK':
                return new NickMessage($message);
            case 'INVITE':
                return new InviteMessage($message);
            case IrcCommand::RPL_WHOISREGNICK_MSG->value:
                return new WhoisRegNickMessage($message);
            default:
                return new IrcMessage($message);
        }
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
