<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ChannelLimit;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class ChannelLimitTest extends TestCase
{
    public function testNoLimits(): void
    {
        $limit = new ChannelLimit('');
        self::assertSame([], $limit->limits);
        self::assertCount(0, $limit);
    }

    public function testStringValue(): void
    {
        $limit = new ChannelLimit('#:25');
        self::assertSame(['#' => 25], $limit->limits);
        self::assertCount(1, $limit);
        self::assertSame(25, $limit['#']);
        self::assertNull($limit['&']);
        self::assertArrayHasKey('#', $limit);
        self::assertArrayNotHasKey('&', $limit);
    }

    public function testMultipleLimits(): void
    {
        $limit = new ChannelLimit(['#:25', '&:']);
        self::assertSame(['#' => 25, '&' => null], $limit->limits);
        self::assertCount(2, $limit);
        self::assertSame(25, $limit['#']);
        self::assertNull($limit['&']);
        self::assertArrayHasKey('#', $limit);
        self::assertArrayHasKey('&', $limit);
    }

    public function testCombinedLimits(): void
    {
        $limit = new ChannelLimit('#&:25');
        self::assertSame(['#' => 25, '&' => 25], $limit->limits);
        self::assertCount(2, $limit);
        self::assertSame(25, $limit['#']);
        self::assertSame(25, $limit['&']);
        self::assertArrayHasKey('#', $limit);
        self::assertArrayHasKey('&', $limit);
    }

    public function testStringLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Limit must be an integer');
        new ChannelLimit('#:foo');
    }

    public function testInvalidLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Limit must be positive');
        new ChannelLimit('#:0');
    }

    public function testSettingLimit(): void
    {
        $limit = new ChannelLimit('#:10');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelLimit is readonly');
        $limit['#'] = 25;
    }

    public function testAppend(): void
    {
        $limit = new ChannelLimit('#:10');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelLimit is readonly');
        $limit[] = 25;
    }

    public function testUnset(): void
    {
        $limit = new ChannelLimit('#:10');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelLimit is readonly');
        unset($limit['#']);
    }
}
