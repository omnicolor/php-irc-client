<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\InviteExceptions;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class InviteExceptionsTest extends TestCase
{
    public function testDefault(): void
    {
        $invite_exceptions = new InviteExceptions(null);
        self::assertSame('I', (string)$invite_exceptions);
    }

    public function testNotDefault(): void
    {
        $invite_exceptions = new InviteExceptions('q');
        self::assertSame('q', (string)$invite_exceptions);
    }

    public function testTooLong(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Invite exceptions flag must be one character'
        );
        new InviteExceptions('bar');
    }
}
