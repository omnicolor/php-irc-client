<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\TopicLength;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class TopicLengthTest extends TestCase
{
    public function testTopicLengthWithString(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be an integer');
        new TopicLength('foo');
    }

    public function testTopicLengthWithNegativeNumber(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be positive');
        new TopicLength('-1');
    }

    public function testTopicLength(): void
    {
        $topic = new TopicLength('200');
        self::assertSame(200, $topic->value);
        self::assertSame('200', (string)$topic);
    }
}
