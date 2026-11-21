<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests;

use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use ReflectionClass;

#[Small]
class TestCase extends PHPUnitTestCase
{
    protected function callPrivate($object, string $method, array $args): mixed
    {
        $reflector = new ReflectionClass($object::class);
        $method = $reflector->getMethod($method);

        return $method->invokeArgs($object, $args);
    }

    protected function setPrivate($object, string $property, $value = null): void
    {
        $reflector = new ReflectionClass($object::class);
        $property = $reflector->getProperty($property);
        $property->setValue($object, $value);
    }

    protected function getPrivate($object, string $property): mixed
    {
        $reflector = new ReflectionClass($object::class);
        $property = $reflector->getProperty($property);

        return $property->getValue($object);
    }
}
