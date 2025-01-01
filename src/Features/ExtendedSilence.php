<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use Stringable;

use function mb_str_split;

/**
 * Indicates that the server supports filtering extensions to the "SILENCE"
 * command. If a value is specified then it contains the supported filter
 * flags.
 *
 * ESILENCE=CcdiNnPpTtx
 * @see https://docs.inspircd.org/3/modules/silence/#commands
 */
class ExtendedSilence extends Feature implements Stringable
{
    public readonly array $modes;

    public function __construct(public readonly string $value)
    {
        $this->modes = mb_str_split($value);
    }

    #[Override]
    public function __toString(): string
    {
        return $this->value;
    }
}
