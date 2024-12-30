<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ChannelLimit;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class ChannelLimitTest extends TestCase
{
    public function testNoLimits(): void
    {
        $limit = new ChannelLimit('');
        self::assertSame([], $limit->limits);
    }

    public function testStringLimit(): void
    {
        $limit = new ChannelLimit('#:25');
        self::assertSame(['#' => 25], $limit->limits);
    }

    public function testMultipleLimits(): void
    {
        $limit = new ChannelLimit(['#:25', '&:']);
        self::assertSame(['#' => 25, '&' => null], $limit->limits);
    }

    public function testCombinedLimits(): void
    {
        $limit = new ChannelLimit('#&:25');
        self::assertSame(['#' => 25, '&' => 25], $limit->limits);
    }
}
