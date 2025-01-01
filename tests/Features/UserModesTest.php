<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\UserModes;
use Jerodev\PhpIrcClient\UserMode;
use LogicException;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class UserModesTest extends TestCase
{
    public function testTooFewModes(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Not enough user modes');
        new UserModes([]);
    }

    public function testUserModes(): void
    {
        // Freenode's user modes as of writing this test.
        $modes = new UserModes([
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
        $modes = new UserModes(['', '', '', '', '']);
        self::assertCount(4, $modes);
        self::assertCount(4, $modes->modes);
    }

    public function testIsModeSupported(): void
    {
        $modes = new UserModes(['I', 'A', 'B', 'e']);
        self::assertTrue($modes->isSupported('I'));
        self::assertTrue($modes->isSupported(UserMode::Bot));
        self::assertTrue($modes->isSupported(UserMode::ServerAdministrator));
        self::assertFalse($modes->isSupported('z'));
        self::assertFalse($modes->isSupported(UserMode::ViewSpambotReports));
    }

    public function testOffsetExists(): void
    {
        $modes = new UserModes(['', '', '', '', '']);
        self::assertArrayHasKey('A', $modes);
        self::assertArrayHasKey('B', $modes);
        self::assertArrayHasKey('C', $modes);
        self::assertArrayHasKey('D', $modes);
        self::assertArrayNotHasKey('E', $modes);
        self::assertArrayNotHasKey(1, $modes);
    }

    public function testOffsetGet(): void
    {
        $modes = new UserModes(['Ia', '', '', '', '']);
        self::assertSame(['I', 'a'], $modes['A']);
        self::assertSame([], $modes['B']);
        self::assertNull($modes['E']);
    }

    public function testOffsetSet(): void
    {
        $modes = new UserModes(['Ia', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('UserModes are readonly');
        $modes['A'] = ['b'];
    }

    public function testAppend(): void
    {
        $modes = new UserModes(['', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('UserModes are readonly');
        $modes[] = ['b'];
    }

    public function testUnset(): void
    {
        $modes = new UserModes(['', '', '', '', '']);
        self::expectException(LogicException::class);
        self::expectExceptionMessage('UserModes are readonly');
        unset($modes['A']);
    }
}
