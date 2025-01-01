<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\BanExceptions;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class BanExceptionsTest extends TestCase
{
    public function testDefault(): void
    {
        $ban_exceptions = new BanExceptions(null);
        self::assertSame('e', (string)$ban_exceptions);
    }

    public function testNotDefault(): void
    {
        $ban_exceptions = new BanExceptions('q');
        self::assertSame('q', (string)$ban_exceptions);
    }

    public function testTooLong(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Ban exceptions flag must be one character');
        new BanExceptions('bar');
    }
}
