<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\Helpers\EventHandlerCollection;
use Jerodev\PhpIrcClient\IrcChannel;
use Jerodev\PhpIrcClient\IrcClient;
use Jerodev\PhpIrcClient\IrcConnection;
use Jerodev\PhpIrcClient\IrcMessageParser;
use PHPUnit\Framework\Attributes\Small;

use function count;

#[Small]
final class IrcMessageEventTest extends TestCase
{
    public function testKick(): void
    {
        $this->invokeClientEvents(
            ':Jerodev!~Jerodev@foo.bar.be KICK #channel user :Get out!',
            [[new Event(
                'kick',
                [new IrcChannel('#channel'), 'user', 'Jerodev', 'Get out!']
            )]]
        );
    }

    public function testMOTD(): void
    {
        $this->invokeClientEvents(
            ':Jerodev!~Jerodev@foo.bar.be 372 IrcBot :Message of the day',
            [[new Event('motd', ['Message of the day'])]]
        );
    }

    public function testNamesEvent(): void
    {
        $this->invokeClientEvents(
            ':Jerodev!~Jerodev@foo.bar.be 353 IrcBot = #channel :IrcBot @Q OtherUser',
            [
                [new Event('names', [new IrcChannel('#channel'), ['IrcBot', '@Q', 'OtherUser']])],
                [new Event('names#channel', [['IrcBot', '@Q', 'OtherUser']])],
            ]
        );
    }

    public function testPingEvent(): void
    {
        $this->invokeClientEvents('PING :0123456', [[new Event('ping')]]);
        $this->invokeClientEvents(
            "PING :0123456\nPING :0123457",
            [[new Event('ping')], [new Event('ping')]]
        );
    }

    public function testPrivmsgEvent(): void
    {
        $this->invokeClientEvents(
            ':Jerodev!~Jerodev@foo.bar.be PRIVMSG #channel :Hello World!',
            [
                [new Event('message', ['Jerodev', new IrcChannel('#channel'), 'Hello World!'])],
                [new Event('message#channel', ['Jerodev', new IrcChannel('#channel'), 'Hello World!'])],
            ]
        );
    }

    public function testTopicChangeEvent(): void
    {
        $this->invokeClientEvents(
            ':Jerodev!~Jerodev@foo.bar.be TOPIC #channel :My Topic',
            [[new Event('topic', [new IrcChannel('#channel'), 'My Topic'])]]
        );
    }

    private function invokeClientEvents(string $message, array $expectedEvents): void
    {
        $invokedCount = $this->exactly(count($expectedEvents));
        $eventCollection = $this->createMock(EventHandlerCollection::class);
        $eventCollection->expects($invokedCount)
            ->method('invoke')
            ->willReturnCallback(function (Event|null $event) use ($expectedEvents, $invokedCount): void {
                self::assertEquals($event, $expectedEvents[$invokedCount->numberOfInvocations() - 1][0]);
            });

        $connection = $this->getStubBuilder(IrcConnection::class)
            ->setConstructorArgs([''])
            ->onlyMethods(['write'])
            ->getStub();

        $client = new IrcClient('');
        $client->setUser('PhpIrcClient');
        $this->setPrivate($client, 'messageEventHandlers', $eventCollection);
        $this->setPrivate($client, 'connection', $connection);
        $this->setPrivate($client, 'channels', ['#channel' => new IrcChannel('#channel')]);

        foreach ((new IrcMessageParser())->parse($message) as $msg) {
            $this->callPrivate($client, 'handleIrcMessage', [$msg]);
        }
    }
}
