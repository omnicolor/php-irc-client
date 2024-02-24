<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

/**
 * Map of user modes.
 * @see http://docs.dal.net/docs/modes.html
 * @psalm-suppress UnusedClass
 */
enum UserMode: string
{
    //case Deaf = 'd';
    case FloodControlExempt = 'F';
    case Helpful = 'h';
    case HideServerInfo = 'I';
    case Invisible = 'i';
    case IrcOperator = 'o';
    case IrcOperatorLocal = 'O';
    case MaskedHostname = 'H';
    case Registered = 'r';
    case RegisteredOnly = 'R';
    case ReceiveNetworkMessages = 'w';
    case ReceiveServerMessages = 's';
    case SameChannel = 'C';
    case Secure = 'S';
    case ServicesAdministrator = 'a';
    case ServerAdministrator = 'A';
    case Squelch = 'x';
    case SilentSquelch = 'X';
    case Unprotected = 'P';
    case ViewCommands = 'y';
    case ViewConnectNotices = 'c';
    case ViewDebugNotices = 'd';
    case ViewFloodNotices = 'f';
    case ViewGlobopMessages = 'g';
    case ViewKillMessages = 'k';
    case ViewKillMessageFromULinedServers = 'K';
    case ViewOperChatopMessages = 'b';
    case ViewRejectedDroneConnectionNotices = 'j';
    case ViewServerRoutingNotices = 'n';
    case ViewSpambotReports = 'm';
    case ViewStoppedFileTransfers = 'e';
}
