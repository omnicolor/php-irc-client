<?php

declare(strict_types=1);

namespace Tests\Messages;

use Jerodev\PhpIrcClient\Messages\IrcMessage;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class IrcMessageTest extends TestCase
{
    public function testEvents(): void
    {
        $message = new IrcMessage('Hello');
        self::assertSame([], $message->getEvents());
    }
}
