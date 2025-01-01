<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use ArrayAccess;
use Countable;
use Jerodev\PhpIrcClient\UserMode;
use LogicException;
use Override;
use RuntimeException;

use function count;
use function in_array;
use function mb_str_split;

/**
 * There are four categories of user modes, defined as follows:
 * - Type A: Modes that add or remove an address to or from a list. These modes
 *   MUST always have a parameter when sent from the server to a client. A
 *   client MAY issue this type of mode without an argument to obtain the
 *   current contents of the list. The numerics used to retrieve contents of
 *   Type A modes depends on the specific mode. Also see the EXTBAN parameter.
 * - Type B: Modes that change a setting on a user. These modes MUST always
 *   have a parameter.
 * - Type C: Modes that change a setting on a user. These modes MUST have a
 *   parameter when being set, and MUST NOT have a parameter when being unset.
 * - Type D: Modes that change a setting on a user. These modes MUST NOT have a
 *   parameter.
 */
class UserModes extends Feature implements ArrayAccess, Countable
{
    /** @var array{
     *     A: array<int, string>,
     *     B: array<int, string>,
     *     C: array<int, string>,
     *     D: array<int, string>
     * }
     */
    public readonly array $modes;

    public function __construct(array $modes)
    {
        if (4 > count($modes)) {
            throw new RuntimeException('Not enough user modes');
        }
        $this->modes = [
            'A' => mb_str_split($modes[0]),
            'B' => mb_str_split($modes[1]),
            'C' => mb_str_split($modes[2]),
            'D' => mb_str_split($modes[3]),
        ];
    }

    #[Override]
    public function count(): int
    {
        return 4;
    }

    #[Override]
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->modes[$offset]);
    }

    #[Override]
    public function offsetGet(mixed $offset): array|null
    {
        if (!isset($this->modes[$offset])) {
            return null;
        }
        return $this->modes[$offset];
    }

    #[Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new LogicException('UserModes are readonly');
    }

    #[Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new LogicException('UserModes are readonly');
    }

    public function isSupported(UserMode|string $mode): bool
    {
        if ($mode instanceof UserMode) {
            $mode = $mode->value;
        }
        return in_array($mode, $this->modes['A'], true)
            || in_array($mode, $this->modes['B'], true)
            || in_array($mode, $this->modes['C'], true)
            || in_array($mode, $this->modes['D'], true);
    }
}
