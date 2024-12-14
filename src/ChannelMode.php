<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

/**
 * Map of channel modes.
 * @see http://docs.dal.net/docs/modes.html
 * @see https://libera.chat/guides/channelmodes
 */
enum ChannelMode: string
{
    case Auditorium = 'A';
    case Ban = 'b';
    case BanExemption = 'e';
    case Colorless = 'c';
    case Forward = 'f';
    case ForwardBlocked = 'Q';
    case ForwardEnabled = 'F';
    case HalfOperator = 'h';
    case InviteFree = 'g';
    case InviteExemption = 'I';
    case InviteOnly = 'i';
    case JoinThrottling = 'j';
    case KeyRequired = 'k';
    case Limited = 'l';
    case Listed = 'L';
    case Moderated = 'm';
    case Muted = 'M';
    case NoExternalMessages = 'n';
    case NoNickChanges = 'N';
    case Operator = 'o';
    case OperatorOnly = 'O';
    case Owner = 'q';
    case Private = 'p';
    case Registered = 'r';
    case RegisteredOnly = 'R';
    case Secret = 's';
    case Secure = 'S';
    //case SilenceUnidentified = 'R';
    //case StripFormatting = 'S';
    case Unprotected = 'P';
    case TopicLocked = 't';
    case Voice = 'v';
}
