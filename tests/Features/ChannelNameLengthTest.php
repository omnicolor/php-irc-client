<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ChannelNameLength;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class ChannelNameLengthTest extends TestCase
{
    public function testLengthAsString(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be an integer');
        new ChannelNameLength('foo');
    }

    public function testLengthZero(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be positive');
        new ChannelNameLength('0');
    }

    public function testLength(): void
    {
        $length = new ChannelNameLength('50');
        self::assertSame(50, $length->value);
        self::assertSame('50', (string)$length);
    }
}
