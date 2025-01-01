<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Messages;

use Jerodev\PhpIrcClient\IrcClient;

use function array_merge;
use function array_pop;
use function array_shift;
use function count;
use function explode;
use function implode;
use function str_contains;
use function str_starts_with;
use function trim;

/**
 * The server sends an ISupport message to the client to advertise what
 * features they support. The server may send more than one, which are meant to
 * be additive, since each is individually limited to a certain length.
 */
class ISupportMessage extends IrcMessage
{
    /** @var array<string, array<int, string>|string> */
    public static array $supported = [];

    public function __construct(protected string $command)
    {
        $this->parseCommand();
    }

    protected function parseCommand(): void
    {
        if (
            str_starts_with($this->command, ':')
            && str_contains($this->command, ' ')
        ) {
            $parts = explode(' ', $this->command);
            $this->source = trim(array_shift($parts), ':');
            $this->command = implode(' ', $parts);
        }

        $parts = explode(' ', $this->command);

        // Next is the numeric command (005).
        array_shift($parts);

        // Next is our nickname.
        array_shift($parts);

        // The rest is supported stuff, up to a : character, which isn't
        // necessarily the first : character.
        $parts = explode(':', implode(' ', $parts));
        if ('are supported by this server' === trim($parts[count($parts) - 1])) {
            array_pop($parts);
        }
        $parts = implode(':', $parts);

        // Now parse out the support.
        $parts = explode(' ', $parts);
        foreach ($parts as $token) {
            [$parameter, $value] = array_merge(
                explode('=', $token),
                [1 => true],
            );
            if ('' === $parameter) {
                continue;
            }
            if (str_starts_with($parameter, '-')) {
                unset(self::$supported[$parameter]);
                continue;
            }

            if (true === $value) {
                self::$supported[$parameter] = true;
                continue;
            }

            $value = explode(',', $value);
            if (1 === count($value)) {
                self::$supported[$parameter] = $value[0];
                continue;
            }
            self::$supported[$parameter] = $value;
        }
    }

    public function handle(IrcClient $client, bool $force = false): void
    {
        $client->getConnection()->setSupport(self::$supported);
    }
}
