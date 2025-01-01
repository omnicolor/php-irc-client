<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\Prefixes;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class PrefixesTest extends TestCase
{
    public function testNull(): void
    {
        $prefixes = new Prefixes(null);
        self::assertCount(0, $prefixes);
    }

    public function testDefault(): void
    {
        $prefixes = new Prefixes('(ov)@+');
        self::assertCount(2, $prefixes);

        self::assertSame('o', $prefixes->getModeForPrefix('@'));
        self::assertSame('v', $prefixes->getModeForPrefix('+'));
        self::assertNull($prefixes->getModeForPrefix('~'));

        self::assertSame('@', $prefixes->getPrefixForMode('o'));
        self::assertSame('+', $prefixes->getPrefixForMode('v'));
        self::assertNull($prefixes->getPrefixForMode('i'));
    }

    public function testMissingParenthesis(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Prefix must be of form "(modes)prefixes"',
        );
        new Prefixes('test');
    }

    public function testUnmatchedPairs(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('Prefixes and modes must be pairs');
        new Prefixes('(ov)@');
    }

    public function testDuplicateKeys(): void
    {
        $prefixes = new Prefixes('(oo)@+');
        self::assertCount(1, $prefixes);
        self::assertSame('+', $prefixes->getPrefixForMode('o'));
        self::assertNull($prefixes->getModeForPrefix('@'));
        self::assertSame('o', $prefixes->getModeForPrefix('+'));
    }
}
