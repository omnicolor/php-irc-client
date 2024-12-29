<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Helpers;

use Jerodev\PhpIrcClient\Helpers\Event;
use Jerodev\PhpIrcClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\Small;

#[Small]
final class EventTest extends TestCase
{
    public function testGetArgumentsEmpty(): void
    {
        $event = new Event('testing');
        self::assertSame([], $event->getArguments());
    }

    public function testGetArguments(): void
    {
        $arguments = [
            'foo' => 'bar',
        ];
        $event = new Event('testing', $arguments);
        self::assertSame($arguments, $event->getArguments());
    }

    public function testGetEvent(): void
    {
        $event = new Event('event name');
        self::assertSame('event name', $event->getEvent());
    }
}
