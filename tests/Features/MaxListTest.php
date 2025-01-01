<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\MaxList;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class MaxListTest extends TestCase
{
    public function testMultipleSameLimits(): void
    {
        $max_list = new MaxList('beI:25');
        self::assertCount(3, $max_list);
        self::assertSame(25, $max_list['b']);
        self::assertSame(25, $max_list['e']);
        self::assertSame(25, $max_list['I']);
        self::assertNull($max_list['c']);
        self::assertArrayHasKey('b', $max_list);
        self::assertArrayNotHasKey('c', $max_list);
    }

    public function testMultipleDifferentLimits(): void
    {
        $max_list = new MaxList(['b:25', 'e:10', 'c:60']);
        self::assertCount(3, $max_list);
        self::assertSame(25, $max_list['b']);
        self::assertSame(10, $max_list['e']);
        self::assertSame(60, $max_list['c']);
    }

    public function testNoLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Limit must be an integer');
        new MaxList('B:');
    }

    public function testStringLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Limit must be an integer');
        new MaxList('B:foo');
    }

    public function testInvalidLimit(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Limit must be positive');
        new MaxList('B:0');
    }

    public function testOffsetSet(): void
    {
        self::expectException(LogicException::class);
        self::expectExceptionMessage('MaxList is readonly');
        $max_list = new MaxList('b:1');
        $max_list['b'] = 25;
    }

    public function testOffsetUnset(): void
    {
        self::expectException(LogicException::class);
        self::expectExceptionMessage('MaxList is readonly');
        $max_list = new MaxList('b:1');
        unset($max_list['b']);
    }
}
