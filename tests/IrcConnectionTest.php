<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests;

use Exception;
use Jerodev\PhpIrcClient\IrcConnection;
use PHPUnit\Framework\Attributes\Small;

#[Small]
final class IrcConnectionTest extends TestCase
{
    public function testIsConnectedNotConnected(): void
    {
        $connection = new IrcConnection('chat.example.com');
        self::assertFalse($connection->isConnected());
    }

    public function testGetServer(): void
    {
        $connection = new IrcConnection('chat.example.com');
        self::assertSame('chat.example.com', $connection->getServer());
    }

    public function testWriteWithoutConnection(): void
    {
        $connection = new IrcConnection('chat.example.com');
        self::expectException(Exception::class);
        self::expectExceptionMessage(
            'No open connection was found to write commands to.'
        );
        $connection->write('testing');
    }

    public function testSetSupportEmpty(): void
    {
        $connection = new IrcConnection('chat.example.com');
        $connection->setSupport([]);
        self::assertCount(0, $connection->features);
    }

    public function testSetSupport(): void
    {
        $connection = new IrcConnection('chat.example.com');
        $connection->setSupport(['TARGETMAX' => 'PRIVMSG:1', 'INVALID' => '5']);
        self::assertCount(1, $connection->features);
    }
}
