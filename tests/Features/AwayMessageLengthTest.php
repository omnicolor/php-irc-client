<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\AwayMessageLength;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class AwayMessageLengthTest extends TestCase
{
    public function testAwayMessageLengthWithString(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be an integer');
        new AwayMessageLength('foo');
    }

    public function testAwayMessageLengthWithNegativeNumber(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be positive');
        new AwayMessageLength('-1');
    }

    public function testAwayMessageLength(): void
    {
        $away_len = new AwayMessageLength('200');
        self::assertSame(200, $away_len->value);
        self::assertSame('200', (string)$away_len);
    }
}
