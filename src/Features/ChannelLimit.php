<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use function array_merge;
use function explode;
use function is_array;
use function mb_str_split;
use function mb_strlen;

/**
 * The CHANLIMIT parameter indicates the number of channels a client may join.
 *
 * The value MUST be specified and is a list of "<prefixes>:<limit>" pairs,
 * delimited by a comma (',', 0x2C). <prefixes> is a list of channel prefix
 * characters as defined in the CHANTYPES parameter. <limit> is OPTIONAL and if
 * specified is a positive integer indicating the maximum number of these types
 * of channels a client may join. If there is no limit to the number of these
 * channels a client may join, <limit> will not be specified.
 *
 * Clients should not assume other clients are limited to what is specified in
 * the CHANLIMIT parameter.
 *
 * The message parser has already broken the comma-separated values into an
 * array.
 */
class ChannelLimit extends Feature
{
    public readonly array $limits;

    public function __construct(array|string $value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        $limits = [];
        while ($limit = current($value)) {
            [$prefix, $limit] = array_merge(
                explode(':', $limit),
                [1 => null],
            );
            if (1 !== mb_strlen($prefix)) {
                // multiple prefixes.
                $prefixes = mb_str_split($prefix);
                foreach ($prefixes as $prefix) {
                    $value[] = $prefix . ':' . ($limit ?? '');
                }
                next($value);
                continue;
            }

            if ('' === $limit) {
                $limits[$prefix] = null;
                next($value);
                continue;
            }

            $limits[$prefix] = (int)$limit;
            next($value);
        }

        $this->limits = $limits;
    }
}
