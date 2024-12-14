<?php

declare(strict_types=1);

use Jerodev\PhpIrcClient\Messages\IrcMessage;
use PHPUnit\Framework\TestCase;

/**
 * @small
 */
final class IrcMessageTest extends TestCase
{
    public function testEvents(): void
    {
        $message = new IrcMessage('Hello');
        self::assertSame([], $message->getEvents());
    }
}
