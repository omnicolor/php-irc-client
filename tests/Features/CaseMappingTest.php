<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\CaseMapping;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class CaseMappingTest extends TestCase
{
    public function testDefault(): void
    {
        $mapping = new CaseMapping();
        self::assertSame('rfc1459', (string)$mapping);
    }

    public function testMapping(): void
    {
        $mapping = new CaseMapping('ascii');
        self::assertSame('ascii', $mapping->value);
    }
}
