<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests;

use Jerodev\PhpIrcClient\IrcMessageParser;
use Jerodev\PhpIrcClient\Messages\IrcMessage;
use Jerodev\PhpIrcClient\Messages\MOTDMessage;
use Jerodev\PhpIrcClient\Messages\NameReplyMessage;
use Jerodev\PhpIrcClient\Messages\PingMessage;
use Jerodev\PhpIrcClient\Messages\PrivmsgMessage;
use Jerodev\PhpIrcClient\Messages\TopicChangeMessage;
use PHPUnit\Framework\Attributes\Small;

#[Small]
final class IrcMessageTest extends TestCase
{
    public function testParseMultiple(): void
    {
        $msg = "PING :0123456\nPING :0123457";
        $commands = iterator_to_array((new IrcMessageParser())->parse($msg));

        self::assertEquals([
            new PingMessage('PING :0123456'),
            new PingMessage('PING :0123457'),
        ], $commands);
    }

    public function testParseMotd(): void
    {
        $msg = new MOTDMessage(':Jerodev!~Jerodev@foo.bar.be 372 IrcBot :Message of the day');

        self::assertSame('Jerodev!~Jerodev@foo.bar.be', $this->getPrivate($msg, 'source'));
        self::assertSame('372', $this->getPrivate($msg, 'command'));
        self::assertSame('IrcBot', $this->getPrivate($msg, 'commandsuffix'));
        self::assertSame('Message of the day', $this->getPrivate($msg, 'payload'));
    }

    public function testParseNameReply(): void
    {
        $msg = new NameReplyMessage(':Jerodev!~Jerodev@foo.bar.be 353 IrcBot = #channel :IrcBot @Q OtherUser');

        self::assertSame('Jerodev!~Jerodev@foo.bar.be', $this->getPrivate($msg, 'source'));
        self::assertSame('353', $this->getPrivate($msg, 'command'));
        self::assertSame('IrcBot = #channel', $this->getPrivate($msg, 'commandsuffix'));
        self::assertSame('IrcBot @Q OtherUser', $this->getPrivate($msg, 'payload'));
        self::assertSame('#channel', $msg->channel->getName());
        self::assertSame(['IrcBot', '@Q', 'OtherUser'], $msg->names);
    }

    public function testParseTopicReply(): void
    {
        $msg = new IrcMessage(':Jerodev!~Jerodev@foo.bar.be TOPIC #channel :The newest channel topic!');

        self::assertSame('Jerodev!~Jerodev@foo.bar.be', $this->getPrivate($msg, 'source'));
        self::assertSame('TOPIC', $this->getPrivate($msg, 'command'));
        self::assertSame('#channel', $this->getPrivate($msg, 'commandsuffix'));
        self::assertSame('The newest channel topic!', $this->getPrivate($msg, 'payload'));
    }

    public function testParseTopicReplyNumeric(): void
    {
        $msg = new TopicChangeMessage(':Jerodev!~Jerodev@foo.bar.be 332 BotName #channel :The newest channel topic!!');

        self::assertSame('Jerodev!~Jerodev@foo.bar.be', $this->getPrivate($msg, 'source'));
        self::assertSame('332', $this->getPrivate($msg, 'command'));
        self::assertSame('#channel', $msg->channel->getName());
        self::assertSame('The newest channel topic!!', $msg->topic);
    }

    public function testParseUserMessage(): void
    {
        $msg = new PrivmsgMessage(':Jerodev!~Jerodev@foo.bar.be PRIVMSG #channel :Hello World!');

        self::assertSame('Jerodev!~Jerodev@foo.bar.be', $this->getPrivate($msg, 'source'));
        self::assertSame('Jerodev', $msg->user);
        self::assertSame('PRIVMSG', $this->getPrivate($msg, 'command'));
        self::assertSame('#channel', $msg->target);
        self::assertSame('#channel', $this->getPrivate($msg, 'commandsuffix'));
        self::assertSame('Hello World!', $msg->message);
        self::assertSame('Hello World!', $this->getPrivate($msg, 'payload'));
    }
}
