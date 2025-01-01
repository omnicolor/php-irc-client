<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use RuntimeException;

/**
 * If SAFELIST parameter is advertised, the server ensures that a client may
 * perform the LIST command without being disconnected due to the large volume
 * of data the LIST command generates.
 *
 * The SAFELIST parameter MUST NOT be specified with a value.
 */
class SafeList extends Feature
{
    public function __construct(bool|string $value)
    {
        if (true !== $value) {
            throw new RuntimeException('SafeList must not have a value');
        }
    }
}
