<?php

declare(strict_types=1);

namespace Jerodev\PhpIrcClient;

enum IrcCommand: string
{
    case RPL_WELCOME = '001';
    case RPL_YOURHOST = '002';
    case RPL_CREATED = '003';
    case RPL_MYINFO = '004';
    case RPL_ISUPPORT = '005';
    case RPL_SNOMASKIS = '008';
    case RPL_BOUNCE = '010';
    case RPL_TRACELINK = '200';
    case RPL_TRACECONNECTING = '201';
    case RPL_TRACEHANDSHAKE = '202';
    case RPL_TRACEUNKNOWN = '203';
    case RPL_TRACEOPERATOR = '204';
    case RPL_TRACEUSER = '205';
    case RPL_TRACESERVER = '206';
    case RPL_TRACESERVICE = '207';
    case RPL_TRACENEWTYPE = '208';
    case RPL_TRACECLASS = '209';
    case RPL_TRACERECONNECT = '210';
    case RPL_STATSLINKINFO = '211';
    case RPL_STATSCOMMANDS = '212';
    case RPL_ENDOFSTATS = '219';
    case RPL_UMODEIS = '221';
    case RPL_SERVLIST = '234';
    case RPL_SERVLISTEND = '235';
    case RPL_STATSUPTIME = '242';
    case RPL_STATSOLINE = '243';
    case RPL_LUSERCLIENT = '251';
    case RPL_LUSEROP = '252';
    case RPL_LUSERUNKNOWN = '253';
    case RPL_LUSERCHANNELS = '254';
    case RPL_LUSERME = '255';
    case RPL_ADMINME = '256';
    case RPL_ADMINLOC1 = '257';
    case RPL_ADMINLOC2 = '258';
    case RPL_ADMINEMAIL = '259';
    case RPL_TRACELOG = '261';
    case RPL_TRACEEND = '262';
    case RPL_TRYAGAIN = '263';
    case RPL_LOCALUSERS = '265';
    case RPL_GLOBALUSERS = '266';
    case RPL_WHOISCERTFP = '276';
    case RPL_AWAY = '301';
    case RPL_USERHOST = '302';
    case RPL_ISON = '303';
    case RPL_UNAWAY = '305';
    case RPL_NOWAWAY = '306';
    case RPL_WHOISREGNICK_MSG = '307';
    case RPL_WHOISUSER = '311';
    case RPL_WHOISSERVER = '312';
    case RPL_WHOISOPERATOR = '313';
    case RPL_WHOWASUSER = '314';
    case RPL_ENDOFWHO = '315';
    case RPL_WHOISIDLE = '317';
    case RPL_ENDOFWHOIS = '318';
    case RPL_WHOISCHANNELS = '319';
    case RPL_LIST = '322';
    case RPL_LISTEND = '323';
    case RPL_CHANNELMODEIS = '324';
    case RPL_UNIQOPIS = '325';
    case RPL_CREATIONTIME = '329';
    case RPL_WHOISACCOUNT = '330';
    case RPL_NOTOPIC = '331';
    case RPL_TOPIC = '332';
    case RPL_TOPICTIME = '333';
    case RPL_WHOISBOT = '335';
    case RPL_WHOISACTUALLY = '338';
    case RPL_INVITING = '341';
    case RPL_SUMMONING = '342';
    case RPL_INVITELIST = '346';
    case RPL_ENDOFINVITELIST = '347';
    case RPL_EXCEPTLIST = '348';
    case RPL_ENDOFEXCEPTLIST = '349';
    case RPL_VERSION = '351';
    case RPL_WHOREPLY = '352';
    case RPL_NAMREPLY = '353';
    case RPL_WHOSPCRPL = '354';
    case RPL_LINKS = '364';
    case RPL_ENDOFLINKS = '365';
    case RPL_ENDOFNAMES = '366';
    case RPL_BANLIST = '367';
    case RPL_ENDOFBANLIST = '368';
    case RPL_ENDOFWHOWAS = '369';
    case RPL_INFO = '371';
    case RPL_MOTD = '372';
    case RPL_ENDOFINFO = '374';
    case RPL_MOTDSTART = '375';
    case RPL_ENDOFMOTD = '376';
    case RPL_WHOISMODES = '379';
    case RPL_YOUREOPER = '381';
    case RPL_REHASHING = '382';
    case RPL_YOURESERVICE = '383';
    case RPL_TIME = '391';
    case RPL_USERSSTART = '392';
    case RPL_USERS = '393';
    case RPL_ENDOFUSERS = '394';
    case RPL_NOUSERS = '395';
    case ERR_UNKNOWNERROR = '400';
    case ERR_NOSUCHNICK = '401';
    case ERR_NOSUCHSERVER = '402';
    case ERR_NOSUCHCHANNEL = '403';
    case ERR_CANNOTSENDTOCHAN = '404';
    case ERR_TOOMANYCHANNELS = '405';
    case ERR_WASNOSUCHNICK = '406';
    case ERR_TOOMANYTARGETS = '407';
    case ERR_NOSUCHSERVICE = '408';
    case ERR_NOORIGIN = '409';
    case ERR_INVALIDCAPCMD = '410';
    case ERR_NORECIPIENT = '411';
    case ERR_NOTEXTTOSEND = '412';
    case ERR_NOTOPLEVEL = '413';
    case ERR_WILDTOPLEVEL = '414';
    case ERR_BADMASK = '415';
    case ERR_INPUTTOOLONG = '417';
    case ERR_UNKNOWNCOMMAND = '421';
    case ERR_NOMOTD = '422';
    case ERR_NOADMININFO = '423';
    case ERR_FILEERROR = '424';
    case ERR_NONICKNAMEGIVEN = '431';
    case ERR_ERRONEUSNICKNAME = '432';
    case ERR_NICKNAMEINUSE = '433';
    case ERR_NICKCOLLISION = '436';
    case ERR_UNAVAILRESOURCE = '437';
    case ERR_REG_UNAVAILABLE = '440';
    case ERR_USERNOTINCHANNEL = '441';
    case ERR_NOTONCHANNEL = '442';
    case ERR_USERONCHANNEL = '443';
    case ERR_NOLOGIN = '444';
    case ERR_SUMMONDISABLED = '445';
    case ERR_USERSDISABLED = '446';
    case ERR_NOTREGISTERED = '451';
    case ERR_NEEDMOREPARAMS = '461';
    case ERR_ALREADYREGISTRED = '462';
    case ERR_NOPERMFORHOST = '463';
    case ERR_PASSWDMISMATCH = '464';
    case ERR_YOUREBANNEDCREEP = '465';
    case ERR_YOUWILLBEBANNED = '466';
    case ERR_KEYSET = '467';
    case ERR_INVALIDUSERNAME = '468';
    case ERR_LINKCHANNEL = '470';
    case ERR_CHANNELISFULL = '471';
    case ERR_UNKNOWNMODE = '472';
    case ERR_INVITEONLYCHAN = '473';
    case ERR_BANNEDFROMCHAN = '474';
    case ERR_BADCHANNELKEY = '475';
    case ERR_BADCHANMASK = '476';
    case ERR_NEEDREGGEDNICK = '477';
    case ERR_BANLISTFULL = '478';
    case ERR_NOPRIVILEGES = '481';
    case ERR_CHANOPRIVSNEEDED = '482';
    case ERR_CANTKILLSERVER = '483';
    case ERR_RESTRICTED = '484';
    case ERR_UNIQOPPRIVSNEEDED = '485';
    case ERR_NOOPERHOST = '491';
    case ERR_UMODEUNKNOWNFLAG = '501';
    case ERR_USERSDONTMATCH = '502';
    case ERR_HELPNOTFOUND = '524';
    case ERR_CANNOTSENDRP = '573';
    case RPL_WHOWASIP = '652';
    case RPL_WHOISSECURE = '671';
    case RPL_YOURLANGUAGESARE = '687';
    case ERR_INVALIDMODEPARAM = '696';
    case ERR_LISTMODEALREADYSET = '697';
    case ERR_LISTMODENOTSET = '698';
    case RPL_HELPSTART = '704';
    case RPL_HELPTXT = '705';
    case RPL_ENDOFHELP = '706';
    case ERR_NOPRIVS = '723';
    case RPL_MONONLINE = '730';
    case RPL_MONOFFLINE = '731';
    case RPL_MONLIST = '732';
    case RPL_ENDOFMONLIST = '733';
    case ERR_MONLISTFULL = '734';
    case RPL_LOGGEDIN = '900';
    case RPL_LOGGEDOUT = '901';
    case ERR_NICKLOCKED = '902';
    case RPL_SASLSUCCESS = '903';
    case ERR_SASLFAIL = '904';
    case ERR_SASLTOOLONG = '905';
    case ERR_SASLABORTED = '906';
    case ERR_SASLALREADY = '907';
    case RPL_SASLMECHS = '908';
    case ERR_TOOMANYLANGUAGES = '981';
    case ERR_NOLANGUAGE = '982';
}
