<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\Bot;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class BotTest extends TestCase
{
    public function testDefault(): void
    {
        $caller_id = new Bot(null);
        self::assertSame('B', (string)$caller_id);
    }

    public function testNotDefault(): void
    {
        $caller_id = new Bot('q');
        self::assertSame('q', (string)$caller_id);
    }

    public function testTooLong(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Bot flag must be one character'
        );
        new Bot('bar');
    }
}
