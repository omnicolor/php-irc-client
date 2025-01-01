<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\NetworkName;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class NetworkNameTest extends TestCase
{
    public function testNetwork(): void
    {
        $name = new NetworkName('☃ Network');
        self::assertSame('☃ Network', $name->name);
        self::assertSame('☃ Network', (string)$name);
    }
}
