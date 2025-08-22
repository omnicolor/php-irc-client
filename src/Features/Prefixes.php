<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use Countable;
use Override;
use RuntimeException;

use function array_combine;
use function array_search;
use function count;
use function mb_str_split;
use function preg_match;

/**
 * Within channels, clients can have different statuses, denoted by
 * single-character prefixes. The PREFIX parameter specifies these prefixes and
 * the channel mode characters that they are mapped to. There is a one-to-one
 * mapping between prefixes and channel modes. The prefixes in this parameter
 * are in descending order, from the prefix that gives the most privileges to
 * the prefix that gives the least.
 *
 * The typical prefixes advertised in this parameter are listed in the Channel
 * Membership Prefixes section.
 *
 * The value is OPTIONAL and when it is not specified indicates that no
 * prefixes are supported. If the parameter is not published by the server at
 * all, clients SHOULD assume PREFIX=(ov)@+, corresponding to the RFC1459
 * behavior.
 */
class Prefixes extends Feature implements Countable
{
    private readonly array $modes;

    public function __construct(null|string $value)
    {
        if (null === $value) {
            $this->modes = [];
            return;
        }

        $matches = null;
        $result = preg_match('/^\((\S+)\)(.+)/', $value, $matches);
        if (0 === $result) {
            throw new RuntimeException(
                'Prefix must be of form "(modes)prefixes"'
            );
        }
        [, $modes, $prefixes] = $matches;
        $modes = mb_str_split($modes);
        $prefixes = mb_str_split($prefixes);

        if (count($modes) !== count($prefixes)) {
            throw new RuntimeException('Prefixes and modes must be pairs');
        }

        $this->modes = array_combine($modes, $prefixes);
    }

    #[Override]
    public function count(): int
    {
        return count($this->modes);
    }

    public function getModeForPrefix(string $prefix): null|string
    {
        $mode = array_search($prefix, $this->modes, true);
        if (false === $mode) {
            return null;
        }

        return $mode;
    }

    public function getPrefixForMode(string $mode): null|string
    {
        return $this->modes[$mode] ?? null;
    }
}
