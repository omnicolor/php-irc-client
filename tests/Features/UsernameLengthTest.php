<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\UsernameLength;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class UsernameLengthTest extends TestCase
{
    public function testUsernameLengthNotInteger(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be an integer');
        new UsernameLength('foo');
    }

    public function testLengthZero(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be positive');
        new UsernameLength('0');
    }

    public function testLength(): void
    {
        $length = new UsernameLength('50');
        self::assertSame(50, $length->value);
        self::assertSame('50', (string)$length);
    }
}
