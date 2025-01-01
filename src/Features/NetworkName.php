<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Override;
use Stringable;

/**
 * The NETWORK parameter indicates the name of the IRC network that the client
 * is connected to. This parameter is advertised for INFORMATIONAL PURPOSES
 * ONLY. Clients SHOULD NOT use this value to make assumptions about supported
 * features on the server as networks may change server software and
 * configuration at any time.
 */
class NetworkName extends Feature implements Stringable
{
    public function __construct(public readonly string $name)
    {
    }

    #[Override]
    public function __toString(): string
    {
        return $this->name;
    }
}
