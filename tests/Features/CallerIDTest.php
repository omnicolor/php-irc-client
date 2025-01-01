<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\CallerID;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class CallerIDTest extends TestCase
{
    public function testDefault(): void
    {
        $caller_id = new CallerID(null);
        self::assertSame('g', (string)$caller_id);
    }

    public function testNotDefault(): void
    {
        $caller_id = new CallerID('q');
        self::assertSame('q', (string)$caller_id);
    }

    public function testTooLong(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'Caller ID flag must be one character'
        );
        new CallerID('bar');
    }
}
