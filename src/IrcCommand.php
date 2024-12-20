<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

final class IrcCommand
{
    public const RPL_WELCOME = '001';
    public const RPL_YOURHOST = '002';
    public const RPL_CREATED = '003';
    public const RPL_MYINFO = '004';
    public const RPL_ISUPPORT = '005';
    public const RPL_SNOMASKIS = '008';
    public const RPL_BOUNCE = '010';
    public const RPL_TRACELINK = '200';
    public const RPL_TRACECONNECTING = '201';
    public const RPL_TRACEHANDSHAKE = '202';
    public const RPL_TRACEUNKNOWN = '203';
    public const RPL_TRACEOPERATOR = '204';
    public const RPL_TRACEUSER = '205';
    public const RPL_TRACESERVER = '206';
    public const RPL_TRACESERVICE = '207';
    public const RPL_TRACENEWTYPE = '208';
    public const RPL_TRACECLASS = '209';
    public const RPL_TRACERECONNECT = '210';
    public const RPL_STATSLINKINFO = '211';
    public const RPL_STATSCOMMANDS = '212';
    public const RPL_ENDOFSTATS = '219';
    public const RPL_UMODEIS = '221';
    public const RPL_SERVLIST = '234';
    public const RPL_SERVLISTEND = '235';
    public const RPL_STATSUPTIME = '242';
    public const RPL_STATSOLINE = '243';
    public const RPL_LUSERCLIENT = '251';
    public const RPL_LUSEROP = '252';
    public const RPL_LUSERUNKNOWN = '253';
    public const RPL_LUSERCHANNELS = '254';
    public const RPL_LUSERME = '255';
    public const RPL_ADMINME = '256';
    public const RPL_ADMINLOC1 = '257';
    public const RPL_ADMINLOC2 = '258';
    public const RPL_ADMINEMAIL = '259';
    public const RPL_TRACELOG = '261';
    public const RPL_TRACEEND = '262';
    public const RPL_TRYAGAIN = '263';
    public const RPL_LOCALUSERS = '265';
    public const RPL_GLOBALUSERS = '266';
    public const RPL_WHOISCERTFP = '276';
    public const RPL_AWAY = '301';
    public const RPL_USERHOST = '302';
    public const RPL_ISON = '303';
    public const RPL_UNAWAY = '305';
    public const RPL_NOWAWAY = '306';
    public const RPL_WHOISREGNICK_MSG = '307';
    public const RPL_WHOISUSER = '311';
    public const RPL_WHOISSERVER = '312';
    public const RPL_WHOISOPERATOR = '313';
    public const RPL_WHOWASUSER = '314';
    public const RPL_ENDOFWHO = '315';
    public const RPL_WHOISIDLE = '317';
    public const RPL_ENDOFWHOIS = '318';
    public const RPL_WHOISCHANNELS = '319';
    public const RPL_LIST = '322';
    public const RPL_LISTEND = '323';
    public const RPL_CHANNELMODEIS = '324';
    public const RPL_UNIQOPIS = '325';
    public const RPL_CREATIONTIME = '329';
    public const RPL_WHOISACCOUNT = '330';
    public const RPL_NOTOPIC = '331';
    public const RPL_TOPIC = '332';
    public const RPL_TOPICTIME = '333';
    public const RPL_WHOISBOT = '335';
    public const RPL_WHOISACTUALLY = '338';
    public const RPL_INVITING = '341';
    public const RPL_SUMMONING = '342';
    public const RPL_INVITELIST = '346';
    public const RPL_ENDOFINVITELIST = '347';
    public const RPL_EXCEPTLIST = '348';
    public const RPL_ENDOFEXCEPTLIST = '349';
    public const RPL_VERSION = '351';
    public const RPL_WHOREPLY = '352';
    public const RPL_NAMREPLY = '353';
    public const RPL_WHOSPCRPL = '354';
    public const RPL_LINKS = '364';
    public const RPL_ENDOFLINKS = '365';
    public const RPL_ENDOFNAMES = '366';
    public const RPL_BANLIST = '367';
    public const RPL_ENDOFBANLIST = '368';
    public const RPL_ENDOFWHOWAS = '369';
    public const RPL_INFO = '371';
    public const RPL_MOTD = '372';
    public const RPL_ENDOFINFO = '374';
    public const RPL_MOTDSTART = '375';
    public const RPL_ENDOFMOTD = '376';
    public const RPL_WHOISMODES = '379';
    public const RPL_YOUREOPER = '381';
    public const RPL_REHASHING = '382';
    public const RPL_YOURESERVICE = '383';
    public const RPL_TIME = '391';
    public const RPL_USERSSTART = '392';
    public const RPL_USERS = '393';
    public const RPL_ENDOFUSERS = '394';
    public const RPL_NOUSERS = '395';
    public const ERR_UNKNOWNERROR = '400';
    public const ERR_NOSUCHNICK = '401';
    public const ERR_NOSUCHSERVER = '402';
    public const ERR_NOSUCHCHANNEL = '403';
    public const ERR_CANNOTSENDTOCHAN = '404';
    public const ERR_TOOMANYCHANNELS = '405';
    public const ERR_WASNOSUCHNICK = '406';
    public const ERR_TOOMANYTARGETS = '407';
    public const ERR_NOSUCHSERVICE = '408';
    public const ERR_NOORIGIN = '409';
    public const ERR_INVALIDCAPCMD = '410';
    public const ERR_NORECIPIENT = '411';
    public const ERR_NOTEXTTOSEND = '412';
    public const ERR_NOTOPLEVEL = '413';
    public const ERR_WILDTOPLEVEL = '414';
    public const ERR_BADMASK = '415';
    public const ERR_INPUTTOOLONG = '417';
    public const ERR_UNKNOWNCOMMAND = '421';
    public const ERR_NOMOTD = '422';
    public const ERR_NOADMININFO = '423';
    public const ERR_FILEERROR = '424';
    public const ERR_NONICKNAMEGIVEN = '431';
    public const ERR_ERRONEUSNICKNAME = '432';
    public const ERR_NICKNAMEINUSE = '433';
    public const ERR_NICKCOLLISION = '436';
    public const ERR_UNAVAILRESOURCE = '437';
    public const ERR_REG_UNAVAILABLE = '440';
    public const ERR_USERNOTINCHANNEL = '441';
    public const ERR_NOTONCHANNEL = '442';
    public const ERR_USERONCHANNEL = '443';
    public const ERR_NOLOGIN = '444';
    public const ERR_SUMMONDISABLED = '445';
    public const ERR_USERSDISABLED = '446';
    public const ERR_NOTREGISTERED = '451';
    public const ERR_NEEDMOREPARAMS = '461';
    public const ERR_ALREADYREGISTRED = '462';
    public const ERR_NOPERMFORHOST = '463';
    public const ERR_PASSWDMISMATCH = '464';
    public const ERR_YOUREBANNEDCREEP = '465';
    public const ERR_YOUWILLBEBANNED = '466';
    public const ERR_KEYSET = '467';
    public const ERR_INVALIDUSERNAME = '468';
    public const ERR_LINKCHANNEL = '470';
    public const ERR_CHANNELISFULL = '471';
    public const ERR_UNKNOWNMODE = '472';
    public const ERR_INVITEONLYCHAN = '473';
    public const ERR_BANNEDFROMCHAN = '474';
    public const ERR_BADCHANNELKEY = '475';
    public const ERR_BADCHANMASK = '476';
    public const ERR_NEEDREGGEDNICK = '477';
    public const ERR_BANLISTFULL = '478';
    public const ERR_NOPRIVILEGES = '481';
    public const ERR_CHANOPRIVSNEEDED = '482';
    public const ERR_CANTKILLSERVER = '483';
    public const ERR_RESTRICTED = '484';
    public const ERR_UNIQOPPRIVSNEEDED = '485';
    public const ERR_NOOPERHOST = '491';
    public const ERR_UMODEUNKNOWNFLAG = '501';
    public const ERR_USERSDONTMATCH = '502';
    public const ERR_HELPNOTFOUND = '524';
    public const ERR_CANNOTSENDRP = '573';
    public const RPL_WHOWASIP = '652';
    public const RPL_WHOISSECURE = '671';
    public const RPL_YOURLANGUAGESARE = '687';
    public const ERR_INVALIDMODEPARAM = '696';
    public const ERR_LISTMODEALREADYSET = '697';
    public const ERR_LISTMODENOTSET = '698';
    public const RPL_HELPSTART = '704';
    public const RPL_HELPTXT = '705';
    public const RPL_ENDOFHELP = '706';
    public const ERR_NOPRIVS = '723';
    public const RPL_MONONLINE = '730';
    public const RPL_MONOFFLINE = '731';
    public const RPL_MONLIST = '732';
    public const RPL_ENDOFMONLIST = '733';
    public const ERR_MONLISTFULL = '734';
    public const RPL_LOGGEDIN = '900';
    public const RPL_LOGGEDOUT = '901';
    public const ERR_NICKLOCKED = '902';
    public const RPL_SASLSUCCESS = '903';
    public const ERR_SASLFAIL = '904';
    public const ERR_SASLTOOLONG = '905';
    public const ERR_SASLABORTED = '906';
    public const ERR_SASLALREADY = '907';
    public const RPL_SASLMECHS = '908';
    public const ERR_TOOMANYLANGUAGES = '981';
    public const ERR_NOLANGUAGE = '982';
}
