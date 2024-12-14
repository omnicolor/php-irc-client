<?php

declare(strict_types=1);

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\IrcClient;
use Jerodev\PhpIrcClient\Messages\KickMessage;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class KickMessageTest extends TestCase
{
    public function testHandle(): void
    {
        $message = new KickMessage(':bob@example.org KICK #channel Alice');
        $client = self::createMock(IrcClient::class);
        $client->method('getNickname')->willReturn('Alice');
        $client->method('shouldAutoRejoin')->willReturn(true);
        // Without the force parameter on handle, it will only be called once.
        $client->expects($this->once())
            ->method('join')
            ->with('#channel');
        $message->handle($client, false);
        $message->handle($client, false);
    }

    public function testHandleWithForce(): void
    {
        $message = new KickMessage(':bob@example.org KICK #channel Alice');
        $client = self::createMock(IrcClient::class);
        $client->method('getNickname')->willReturn('Alice');
        $client->method('shouldAutoRejoin')->willReturn(true);
        $client->expects($this->exactly(2))
            ->method('join')
            ->with('#channel');
        $message->handle($client, true);
        $message->handle($client, true);
    }

    public function testHandleForOtherUser(): void
    {
        $message = new KickMessage(':bob@example.org KICK #channel Alice');
        $client = self::createMock(IrcClient::class);
        $client->method('getNickname')->willReturn('Charlie');
        $client->expects($this->never())->method('shouldAutoRejoin');
        $client->expects($this->never())->method('join');
        $message->handle($client, false);
    }

    public function testHandleWithoutAutoRejoin(): void
    {
        $message = new KickMessage(':bob@example.org KICK #channel Alice');
        $client = self::createMock(IrcClient::class);
        $client->method('getNickname')->willReturn('Alice');
        $client->method('shouldAutoRejoin')->willReturn(false);
        $client->expects($this->never())->method('join');
        $message->handle($client, false);
    }

    public function testGetEvents(): void
    {
        $message = new KickMessage(':bob@example.org KICK #channel Alice Get out!');
        self::assertEquals(
            [
                new Event('kick', [null, 'Alice', 'bob@example.org', '']),
            ],
            $message->getEvents()
        );
    }
}
