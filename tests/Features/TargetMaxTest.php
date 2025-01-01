<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\TargetMax;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class TargetMaxTest extends TestCase
{
    public function testEmpty(): void
    {
        $target_max = new TargetMax([]);
        self::assertCount(0, $target_max->commands);
        self::assertNull($target_max['PRIVMSG']);
        self::assertNull($target_max['KICK']);
    }

    public function testSingleWithLimit(): void
    {
        $target_max = new TargetMax('PRIVMSG:3');
        self::assertCount(1, $target_max->commands);
        self::assertSame(3, $target_max['PRIVMSG']);
        self::assertNull($target_max['KICK']);
    }

    public function testSingleWithoutLimit(): void
    {
        $target_max = new TargetMax('PRIVMSG:');
        self::assertCount(1, $target_max);
        self::assertNull($target_max['PRIVMSG']);
    }

    public function testStringLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be an integer');
        new TargetMax('KICK:foo');
    }

    public function testNegativeLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Value must be positive');
        new TargetMax('KICK:-1');
    }

    public function testMultipleLimits(): void
    {
        $target_max = new TargetMax([
            'NAMES:1',
            'LIST:1',
            'KICK:1',
            'WHOIS:1',
            'PRIVMSG:4',
        ]);
        self::assertCount(5, $target_max->commands);
        self::assertSame(1, $target_max->commands['NAMES']);
        self::assertSame(1, $target_max['NAMES']);
        self::assertSame(4, $target_max['PRIVMSG']);
    }

    public function testUnset(): void
    {
        $target_max = new TargetMax('PRIVMSG:1');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('TargetMax is readonly');
        unset($target_max['PRIVMSG']);
        self::assertSame(1, $target_max['PRIVMSG']);
    }

    public function testSet(): void
    {
        $target_max = new TargetMax([]);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('TargetMax is readonly');
        $target_max['PRIVMSG'] = 15;
        self::assertNull($target_max['PRIVMSG']);
    }

    public function testOffsetIsSet(): void
    {
        $target_max = new TargetMax(['PRIVMSG:5']);
        self::assertArrayHasKey('PRIVMSG', $target_max);
        self::assertArrayHasKey('KICK', $target_max);
        self::assertArrayNotHasKey(1, $target_max);
    }
}
