<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\StatusMessage;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
final class StatusMessageTest extends TestCase
{
    public function testConstructor(): void
    {
        $status_message = new StatusMessage('~&@%+');
        self::assertSame('~&@%+', (string)$status_message);
    }
}
