<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use RuntimeException;
use Stringable;

use function is_numeric;

abstract class NumericFeature extends Feature implements Stringable
{
    public readonly int $value;

    public function __construct(string $value)
    {
        if (!is_numeric($value)) {
            throw new RuntimeException('Value must be an integer');
        }

        if (0 >= (int)$value) {
            throw new RuntimeException('Value must be positive');
        }

        $this->value = (int)$value;
    }

    #[Override]
    public function __toString(): string
    {
        return (string)$this->value;
    }
}
