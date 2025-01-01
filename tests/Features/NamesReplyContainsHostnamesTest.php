<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Features;

use Jerodev\PhpIrcClient\Features\NamesReplyContainsHostnames;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class NamesReplyContainsHostnamesTest extends TestCase
{
    public function testConstructor(): void
    {
        self::expectException(RuntimeException::class);
        self::expectExceptionMessage(
            'UHNAMES must not have a value'
        );
        new NamesReplyContainsHostnames('test');
    }
}
