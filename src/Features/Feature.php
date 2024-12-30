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
            'AWAYLEN' => new AwayMessageLength($value),
            'CASEMAPPING' => new CaseMapping($value),
            'CHANLIMIT' => new ChannelLimit($value),
            'CHANMODES' => new ChannelModes($value),
            'CHANNELLEN' => new ChannelNameLength($value),
            'CHANTYPES' => new ChannelTypes($value),
            'ELIST' => new ExtendedList($value),
            'EXCEPTS' => new BanExceptions($value),
            //'EXTBAN'
            'HOSTLEN' => new HostnameLength($value),
            //'INVEX'
            'KICKLEN' => new KickReasonLength($value),
            //'MAXLIST'
            'MAXTARGETS' => new MaxTargets($value),
            'MODES' => new Modes($value),
            //'NETWORK'
            'NICKLEN' => new NicknameLength($value),
            //'PREFIX'
            //'SAFELIST'
            'SILENCE' => new SilenceListLength($value),
            'STATUSMSG' => new StatusMessage($value),
            'TARGETMAX' => new TargetMax($value),
            'TOPICLEN' => new TopicLength($value),
            'USERLEN' => new UsernameLength($value),
            default => throw new RuntimeException(),
        };
    }
}
