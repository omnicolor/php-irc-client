<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Jerodev\PhpIrcClient\Features\AcceptListLength;
use Jerodev\PhpIrcClient\Features\AwayMessageLength;
use Jerodev\PhpIrcClient\Features\BanExceptions;
use Jerodev\PhpIrcClient\Features\Bot;
use Jerodev\PhpIrcClient\Features\CallerID;
use Jerodev\PhpIrcClient\Features\CaseMapping;
use Jerodev\PhpIrcClient\Features\ChannelKeyLength;
use Jerodev\PhpIrcClient\Features\ChannelLimit;
use Jerodev\PhpIrcClient\Features\ChannelModes;
use Jerodev\PhpIrcClient\Features\ChannelNameLength;
use Jerodev\PhpIrcClient\Features\ChannelTypes;
use Jerodev\PhpIrcClient\Features\ExtendedBanMasks;
use Jerodev\PhpIrcClient\Features\ExtendedList;
use Jerodev\PhpIrcClient\Features\ExtendedSilence;
use Jerodev\PhpIrcClient\Features\ExtendedWho;
use Jerodev\PhpIrcClient\Features\Feature;
use Jerodev\PhpIrcClient\Features\HostnameLength;
use Jerodev\PhpIrcClient\Features\InviteExceptions;
use Jerodev\PhpIrcClient\Features\KickReasonLength;
use Jerodev\PhpIrcClient\Features\LineLength;
use Jerodev\PhpIrcClient\Features\MaxList;
use Jerodev\PhpIrcClient\Features\MaxTargets;
use Jerodev\PhpIrcClient\Features\Modes;
use Jerodev\PhpIrcClient\Features\MonitorListLength;
use Jerodev\PhpIrcClient\Features\NameLength;
use Jerodev\PhpIrcClient\Features\NamesListExtended;
use Jerodev\PhpIrcClient\Features\NamesReplyContainsHostnames;
use Jerodev\PhpIrcClient\Features\NetworkName;
use Jerodev\PhpIrcClient\Features\NicknameLength;
use Jerodev\PhpIrcClient\Features\Prefixes;
use Jerodev\PhpIrcClient\Features\SafeList;
use Jerodev\PhpIrcClient\Features\SecureListTime;
use Jerodev\PhpIrcClient\Features\SilenceListLength;
use Jerodev\PhpIrcClient\Features\StatusMessage;
use Jerodev\PhpIrcClient\Features\TargetMax;
use Jerodev\PhpIrcClient\Features\TopicLength;
use Jerodev\PhpIrcClient\Features\UserIP;
use Jerodev\PhpIrcClient\Features\UserModes;
use Jerodev\PhpIrcClient\Features\UsernameLength;
use Jerodev\PhpIrcClient\Features\VaryingBanListSize;
use Jerodev\PhpIrcClient\Features\VaryingListSize;
use Jerodev\PhpIrcClient\Features\WatchListLength;
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
            ['ACCEPT', '30', AcceptListLength::class],
            ['AWAYLEN', '50', AwayMessageLength::class],
            ['BOT', 'B', Bot::class],
            ['CALLERID', 'g', CallerID::class],
            ['CASEMAPPING', 'ascii', CaseMapping::class],
            ['CHANMODES', ['', '', '', ''], ChannelModes::class],
            ['CHANLIMIT', '25', ChannelLimit::class],
            ['CHANNELLEN', '200', ChannelNameLength::class],
            ['CHANTYPES', '#', ChannelTypes::class],
            ['ELIST', 'CMNTU', ExtendedList::class],
            ['ESILENCE', 'CcdiNnPpTtx', ExtendedSilence::class],
            ['EXCEPTS', 'e', BanExceptions::class],
            ['EXTBAN', ['~', 'ABC'], ExtendedBanMasks::class],
            ['KICKLEN', '25', KickReasonLength::class],
            ['HOSTLEN', '25', HostnameLength::class],
            ['INVEX', 'I', InviteExceptions::class],
            ['KEYLEN', '255', ChannelKeyLength::class],
            ['LINELEN', '255', LineLength::class],
            ['MAXLIST', 'beI:25', MaxList::class],
            ['MAXTARGETS', '3', MaxTargets::class],
            ['MODES', '4', Modes::class],
            ['MONITOR', '20', MonitorListLength::class],
            ['NAMELEN', '255', NameLength::class],
            ['NAMESX', '', NamesListExtended::class],
            ['NETWORK', 'Freenode', NetworkName::class],
            ['NICKLEN', '31', NicknameLength::class],
            ['PREFIX', '(ov)@+', Prefixes::class],
            ['SAFELIST', true, SafeList::class],
            ['SECURELIST', '60', SecureListTime::class],
            ['SILENCE', '20', SilenceListLength::class],
            ['STATUSMSG', '~&@%+', StatusMessage::class],
            ['TARGETMAX', [], TargetMax::class],
            ['TOPICLEN', '200', TopicLength::class],
            ['UHNAMES', true, NamesReplyContainsHostnames::class],
            ['USERLEN', '200', UsernameLength::class],
            ['USERIP', '', UserIP::class],
            ['USERMODES', ['', '', 's', 'BDHILR'], UserModes::class],
            ['VBANLIST', true, VaryingBanListSize::class],
            ['VLIST', 'b', VaryingListSize::class],
            ['WATCH', '32', WatchListLength::class],
            ['WHOX', true, ExtendedWho::class],
        ];
    }

    #[DataProvider('featureProvider')]
    public function testMake(string $feature, mixed $value, string $class): void
    {
        self::assertInstanceOf($class, Feature::make($feature, $value));
    }
}
