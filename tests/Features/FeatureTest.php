<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Tests\Feature;

use Iterator;
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

    public static function featureProvider(): Iterator
    {
        yield ['ACCEPT', '30', AcceptListLength::class];
        yield ['AWAYLEN', '50', AwayMessageLength::class];
        yield ['BOT', 'B', Bot::class];
        yield ['CALLERID', 'g', CallerID::class];
        yield ['CASEMAPPING', 'ascii', CaseMapping::class];
        yield ['CHANMODES', ['', '', '', ''], ChannelModes::class];
        yield ['CHANLIMIT', '25', ChannelLimit::class];
        yield ['CHANNELLEN', '200', ChannelNameLength::class];
        yield ['CHANTYPES', '#', ChannelTypes::class];
        yield ['ELIST', 'CMNTU', ExtendedList::class];
        yield ['ESILENCE', 'CcdiNnPpTtx', ExtendedSilence::class];
        yield ['EXCEPTS', 'e', BanExceptions::class];
        yield ['EXTBAN', ['~', 'ABC'], ExtendedBanMasks::class];
        yield ['KICKLEN', '25', KickReasonLength::class];
        yield ['HOSTLEN', '25', HostnameLength::class];
        yield ['INVEX', 'I', InviteExceptions::class];
        yield ['KEYLEN', '255', ChannelKeyLength::class];
        yield ['LINELEN', '255', LineLength::class];
        yield ['MAXLIST', 'beI:25', MaxList::class];
        yield ['MAXTARGETS', '3', MaxTargets::class];
        yield ['MODES', '4', Modes::class];
        yield ['MONITOR', '20', MonitorListLength::class];
        yield ['NAMELEN', '255', NameLength::class];
        yield ['NAMESX', '', NamesListExtended::class];
        yield ['NETWORK', 'Freenode', NetworkName::class];
        yield ['NICKLEN', '31', NicknameLength::class];
        yield ['PREFIX', '(ov)@+', Prefixes::class];
        yield ['SAFELIST', true, SafeList::class];
        yield ['SECURELIST', '60', SecureListTime::class];
        yield ['SILENCE', '20', SilenceListLength::class];
        yield ['STATUSMSG', '~&@%+', StatusMessage::class];
        yield ['TARGETMAX', [], TargetMax::class];
        yield ['TOPICLEN', '200', TopicLength::class];
        yield ['UHNAMES', true, NamesReplyContainsHostnames::class];
        yield ['USERLEN', '200', UsernameLength::class];
        yield ['USERIP', '', UserIP::class];
        yield ['USERMODES', ['', '', 's', 'BDHILR'], UserModes::class];
        yield ['VBANLIST', true, VaryingBanListSize::class];
        yield ['VLIST', 'b', VaryingListSize::class];
        yield ['WATCH', '32', WatchListLength::class];
        yield ['WHOX', true, ExtendedWho::class];
    }

    #[DataProvider('featureProvider')]
    public function testMake(string $feature, mixed $value, string $class): void
    {
        self::assertInstanceOf($class, Feature::make($feature, $value));
    }
}
