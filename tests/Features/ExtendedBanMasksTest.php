<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ExtendedBanMasks;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class ExtendedBanMasksTest extends TestCase
{
    public function testTooFewParameters(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Too few parameters for extended ban masks'
        );
        new ExtendedBanMasks([]);
    }

    public function testMinimum(): void
    {
        $ban_mask = new ExtendedBanMasks(['', '']);
        self::assertSame('', $ban_mask->prefix);
        self::assertCount(0, $ban_mask->types);
    }

    public function testTooLongPrefix(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Prefix must be at most a single character'
        );
        new ExtendedBanMasks(['~~', '']);
    }

    public function testBanMasks(): void
    {
        $ban_mask = new ExtendedBanMasks(['~', 'ABCNOQRSTUcjmprsz']);
        self::assertSame('~', $ban_mask->prefix);
        self::assertCount(17, $ban_mask->types);
    }
}
