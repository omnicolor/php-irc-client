<?php

declare(strict_types=1);

namespace Tests;

use Jerodev\PhpIrcClient\IrcClient;
use Jerodev\PhpIrcClient\IrcMessageParser;
use Jerodev\PhpIrcClient\Options\ClientOptions;
use PHPUnit\Framework\Attributes\Small;

#[Small]
final class IrcClientResponseTest extends TestCase
{
    /**
     * Test autojoining a channel after kick.
     */
    public function testAutoJoinAfterKick(): void
    {
        $options = new ClientOptions('PhpIrcBot', ['#php-irc-client-test']);
        $options->autoRejoin = true;

        $invokedCount = $this->exactly(3);
        $client = $this->getMockBuilder(IrcClient::class)
            ->setConstructorArgs(['', $options])
            ->onlyMethods(['send'])
            ->getMock();
        $client->expects($invokedCount)
            ->method('send')
            ->willReturnCallback(function (string $command) use ($invokedCount): void {
                $expected = [
                    'JOIN #php-irc-client-test',
                    'USER PhpIrcBot * * :PhpIrcBot',
                    'NICK PhpIrcBot',
                ];
                self::assertSame(
                    $expected[$invokedCount->numberOfInvocations() - 1],
                    $command,
                );
            });

        foreach ((new IrcMessageParser())->parse('KICK #php-irc-client-test PhpIrcBot') as $msg) {
            $this->callPrivate($client, 'handleIrcMessage', [$msg]);
        }
    }

    /**
     * Test generating join/part commands.
     */
    public function testJoinPartChannel(): void
    {
        $client = $this->getMockBuilder(IrcClient::class)
            ->setConstructorArgs([''])
            ->onlyMethods(['send'])
            ->getMock();
        $invoked = $this->exactly(2);
        $client->expects($invoked)
            ->method('send')
            ->willReturnCallback(function (string $command) use ($invoked): void {
                $expected = [
                    'JOIN #php-irc-client-test',
                    'PART #php-irc-client-test',
                ];
                self::assertSame(
                    $expected[$invoked->numberOfInvocations() - 1],
                    $command,
                );
            });

        $client->join('#php-irc-client-test');
        $client->part('#php-irc-client-test');
    }

    /**
     * If autojoin is off, the client should not auto rejoin after kick.
     */
    public function testNotAutoJoinAfterKick(): void
    {
        $client = $this->getMockBuilder(IrcClient::class)
            ->setConstructorArgs(['', new ClientOptions('PhpIrcBot', ['#php-irc-client-test'])])
            ->onlyMethods(['send'])
            ->getMock();
        $invoked = $this->exactly(2);
        $client->expects($invoked)
            ->method('send')
            ->willReturnCallback(function (string $command) use ($invoked): void {
                $expected = [
                    'USER PhpIrcBot * * :PhpIrcBot',
                    'NICK PhpIrcBot',
                ];
                self::assertSame(
                    $expected[$invoked->numberOfInvocations() - 1],
                    $command,
                );
            });

        foreach ((new IrcMessageParser())->parse('KICK #php-irc-client-test PhpIrcBot') as $msg) {
            $this->callPrivate($client, 'handleIrcMessage', [$msg]);
        }
    }

    /**
     * Make sure the client returns a PING request with an equal PONG response.
     */
    public function testPingPong(): void
    {
        $client = $this->getMockBuilder(IrcClient::class)
            ->setConstructorArgs([''])
            ->onlyMethods(['send'])
            ->getMock();
        $client->expects($this->once())
            ->method('send')
            ->with('PONG :0123456');

        foreach ((new IrcMessageParser())->parse('PING :0123456') as $msg) {
            $this->callPrivate($client, 'handleIrcMessage', [$msg]);
        }
    }

    /**
     * `sendMessage` should generate a PRIVMSG command.
     */
    public function testSendMessage(): void
    {
        $client = $this->getMockBuilder(IrcClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['send'])
            ->getMock();
        $client->expects($this->once())
            ->method('send')
            ->with('PRIVMSG #channel :Hello World!');

        $client->say('#channel', 'Hello World!');
    }

    /**
     * `sendMessage` should generate multiple PRIVMSG commands for multiline
     * messages.
     */
    public function testSendMultilineMessage(): void
    {
        $client = $this->getMockBuilder(IrcClient::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['send'])
            ->getMock();
        $invoked = $this->exactly(2);
        $client->expects($invoked)
            ->method('send')
            ->willReturnCallback(function (string $command) use ($invoked): void {
                $expected = [
                    'PRIVMSG #channel :Hello',
                    'PRIVMSG #channel :World!',
                ];
                self::assertSame(
                    $expected[$invoked->numberOfInvocations() - 1],
                    $command,
                );
            });

        $client->say('#channel', "Hello\nWorld!");
    }
}
