<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\ChannelMode;
use Jerodev\PhpIrcClient\Features\ChannelModes;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class ChannelModesTest extends TestCase
{
    public function testTooFewModes(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Not enough channel modes');
        new ChannelModes([]);
    }

    public function testChannelModes(): void
    {
        // Freenode's channel modes as of writing this test.
        $modes = new ChannelModes([
            'IXZbew',
            'k',
            'BEFJLWdfjl',
            'ACDKMNOPQRSTUcimnprstuz',
        ]);
        self::assertCount(4, $modes->modes);
        self::assertCount(6, $modes['A']);
        self::assertSame(['k'], $modes['B']);
        self::assertCount(10, $modes['C']);
        self::assertCount(23, $modes['D']);
    }

    public function testAdditionalModes(): void
    {
        $modes = new ChannelModes(['', '', '', '', '']);
        self::assertCount(4, $modes);
        self::assertCount(4, $modes->modes);
    }

    public function testIsModeSupported(): void
    {
        $modes = new ChannelModes(['I', 'A', 'b', 'e']);
        self::assertTrue($modes->isSupported('I'));
        self::assertTrue($modes->isSupported(ChannelMode::Ban));
        self::assertTrue($modes->isSupported(ChannelMode::Auditorium));
        self::assertTrue($modes->isSupported(ChannelMode::BanExemption));
        self::assertFalse($modes->isSupported('z'));
        self::assertFalse($modes->isSupported(ChannelMode::Voice));
    }

    public function testOffsetExists(): void
    {
        $modes = new ChannelModes(['', '', '', '', '']);
        self::assertArrayHasKey('A', $modes);
        self::assertArrayHasKey('B', $modes);
        self::assertArrayHasKey('C', $modes);
        self::assertArrayHasKey('D', $modes);
        self::assertArrayNotHasKey('E', $modes);
        self::assertArrayNotHasKey(1, $modes);
    }

    public function testOffsetGet(): void
    {
        $modes = new ChannelModes(['Ia', '', '', '', '']);
        self::assertSame(['I', 'a'], $modes['A']);
        self::assertSame([], $modes['B']);
        self::assertNull($modes['E']);
    }

    public function testOffsetSet(): void
    {
        $modes = new ChannelModes(['Ia', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelModes are readonly');
        $modes['A'] = ['b'];
    }

    public function testAppend(): void
    {
        $modes = new ChannelModes(['', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelModes are readonly');
        $modes[] = ['b'];
    }

    public function testUnset(): void
    {
        $modes = new ChannelModes(['', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('ChannelModes are readonly');
        unset($modes['A']);
    }
}
