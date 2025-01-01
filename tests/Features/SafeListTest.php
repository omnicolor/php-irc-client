<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\SafeList;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class SafeListTest extends TestCase
{
    public function testConstructor(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage('SafeList must not have a value');
        new SafeList('test');
    }
}
