<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\AwayMessageLength;
use Jerodev\PhpIrcClient\Features\BanExceptions;
use Jerodev\PhpIrcClient\Features\CaseMapping;
use Jerodev\PhpIrcClient\Features\ChannelLimit;
use Jerodev\PhpIrcClient\Features\ChannelModes;
use Jerodev\PhpIrcClient\Features\ChannelNameLength;
use Jerodev\PhpIrcClient\Features\ChannelTypes;
use Jerodev\PhpIrcClient\Features\ExtendedList;
use Jerodev\PhpIrcClient\Features\Feature;
use Jerodev\PhpIrcClient\Features\HostnameLength;
use Jerodev\PhpIrcClient\Features\KickReasonLength;
use Jerodev\PhpIrcClient\Features\MaxTargets;
use Jerodev\PhpIrcClient\Features\Modes;
use Jerodev\PhpIrcClient\Features\NicknameLength;
use Jerodev\PhpIrcClient\Features\SilenceListLength;
use Jerodev\PhpIrcClient\Features\StatusMessage;
use Jerodev\PhpIrcClient\Features\TargetMax;
use Jerodev\PhpIrcClient\Features\TopicLength;
use Jerodev\PhpIrcClient\Features\UsernameLength;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[Small]
final class FeatureTest extends TestCase
{
    public function testMakeInvalid(): void
    {
        self::expectException(RuntimeException::class);
        Feature::make('invaid', false);
    }

    public static function featureProvider(): array
    {
        return [
            ['AWAYLEN', '50', AwayMessageLength::class],
            ['CASEMAPPING', 'ascii', CaseMapping::class],
            ['CHANMODES', ['', '', '', ''], ChannelModes::class],
            ['CHANLIMIT', '25', ChannelLimit::class],
            ['CHANNELLEN', '200', ChannelNameLength::class],
            ['CHANTYPES', '#', ChannelTypes::class],
            ['ELIST', 'CMNTU', ExtendedList::class],
            ['EXCEPTS', 'e', BanExceptions::class],
            ['KICKLEN', '25', KickReasonLength::class],
            ['HOSTLEN', '25', HostnameLength::class],
            ['MAXTARGETS', '3', MaxTargets::class],
            ['MODES', '4', Modes::class],
            ['NICKLEN', '31', NicknameLength::class],
            ['SILENCE', '20', SilenceListLength::class],
            ['STATUSMSG', '~&@%+', StatusMessage::class],
            ['TARGETMAX', [], TargetMax::class],
            ['TOPICLEN', '200', TopicLength::class],
            ['USERLEN', '200', UsernameLength::class],
        ];
    }

    #[DataProvider('featureProvider')]
    public function testMake(string $feature, mixed $value, string $class): void
    {
        self::assertInstanceOf($class, Feature::make($feature, $value));
    }
}
