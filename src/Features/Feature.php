<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient\Features;

use RuntimeException;

abstract class Feature
{
    public static function make(
        string $feature,
        array|bool|string $value
    ): Feature {
        return match ($feature) {
            'ACCEPT' => new AcceptListLength($value),
            'AWAYLEN' => new AwayMessageLength($value),
            'BOT' => new Bot($value),
            'CALLERID' => new CallerID($value),
            'CASEMAPPING' => new CaseMapping($value),
            'CHANLIMIT' => new ChannelLimit($value),
            'CHANMODES' => new ChannelModes($value),
            'CHANNELLEN' => new ChannelNameLength($value),
            'CHANTYPES' => new ChannelTypes($value),
            'ELIST' => new ExtendedList($value),
            'ESILENCE' => new ExtendedSilence($value),
            'EXCEPTS' => new BanExceptions($value),
            'EXTBAN' => new ExtendedBanMasks($value),
            'HOSTLEN' => new HostnameLength($value),
            'INVEX' => new InviteExceptions($value),
            'KEYLEN' => new ChannelKeyLength($value),
            'KICKLEN' => new KickReasonLength($value),
            'LINELEN' => new LineLength($value),
            'MAXLIST' => new MaxList($value),
            'MAXTARGETS' => new MaxTargets($value),
            'MODES' => new Modes($value),
            'MONITOR' => new MonitorListLength($value),
            'NAMELEN' => new NameLength($value),
            'NAMESX' => new NamesListExtended(),
            'NETWORK' => new NetworkName($value),
            'NICKLEN' => new NicknameLength($value),
            'PREFIX' => new Prefixes($value),
            'SAFELIST' => new SafeList($value),
            'SECURELIST' => new SecureListTime($value),
            'SILENCE' => new SilenceListLength($value),
            'STATUSMSG' => new StatusMessage($value),
            'TARGETMAX' => new TargetMax($value),
            'TOPICLEN' => new TopicLength($value),
            'UHNAMES' => new NamesReplyContainsHostnames($value),
            'USERIP' => new UserIP(),
            'USERLEN' => new UsernameLength($value),
            'USERMODES' => new UserModes($value),
            'VBANLIST' => new VaryingBanListSize(),
            'VLIST' => new VaryingListSize($value),
            'WATCH' => new WatchListLength($value),
            'WHOX' => new ExtendedWho(),
            default => throw new RuntimeException(),
        };
    }
}
