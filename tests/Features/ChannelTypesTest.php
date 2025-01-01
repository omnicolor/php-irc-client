<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ChannelTypes;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class ChannelTypesTest extends TestCase
{
    public function testChannelTypesSingle(): void
    {
        $types = new ChannelTypes('#');
        self::assertCount(1, $types);
        self::assertCount(1, $types->types);
        self::assertSame(['#'], $types->types);
        self::assertTrue($types['#']);
        self::assertFalse($types['&']);
        self::assertArrayHasKey('#', $types);
        self::assertArrayNotHasKey('&', $types);
    }

    public function testChannelTypesMultiple(): void
    {
        $types = new ChannelTypes('&#');
        self::assertCount(2, $types->types);
        self::assertSame(['&', '#'], $types->types);
        self::assertTrue($types['#']);
        self::assertTrue($types['&']);
    }

    public function testSetValue(): void
    {
        $types = new ChannelTypes('#');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelTypes is readonly');
        $types['&'] = true;
    }

    public function testAppend(): void
    {
        $types = new ChannelTypes('#');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelTypes is readonly');
        $types[] = true;
    }

    public function testUnset(): void
    {
        $types = new ChannelTypes('#');
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelTypes is readonly');
        unset($types['#']);
    }
}
