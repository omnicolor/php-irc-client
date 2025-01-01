<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ExtendedSilence;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class ExtendedSilenceTest extends TestCase
{
    public function testToString(): void
    {
        $extended_silence = new ExtendedSilence('CcdiNnPpTtx');
        self::assertSame('CcdiNnPpTtx', (string)$extended_silence);
    }

    public function testModes(): void
    {
        $extended_silence = new ExtendedSilence('CcdiNnPpTtx');
        self::assertCount(11, $extended_silence->modes);
    }
}
