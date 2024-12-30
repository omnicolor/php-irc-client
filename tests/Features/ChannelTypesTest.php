<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\ChannelTypes;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class ChannelTypesTest extends TestCase
{
    public function testChannelTypesSingle(): void
    {
        $types = new ChannelTypes('#');
        self::assertCount(1, $types->types);
        self::assertSame(['#'], $types->types);
    }

    public function testChannelTypesMultiple(): void
    {
        $types = new ChannelTypes('&#');
        self::assertCount(2, $types->types);
        self::assertSame(['&', '#'], $types->types);
    }
}
