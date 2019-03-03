<?php

namespace Jerodev\PhpIrcClient;

use Exception;
use Jerodev\PhpIrcClient\Helpers\EventHandlerCollection;
use Jerodev\PhpIrcClient\Messages\IrcMessage;

class IrcClient
{
    /** @var IrcChannel[] */
    private $channels;

    /** @var IrcConnection */
    private $connection;

    /** @var bool */
    private $isAuthenticated;

    /** @var EventHandlerCollection */
    private $messageEventHandlers;

    /** @var IrcUser|null */
    private $user;

    /**
     *  Create a new IrcClient instance.
     *
     *  @param string $server The server address to connect to including the port: `address:port`.
     *  @param null|string $username The username to use on the server. Can be set in more detail using `setUser()`.
     *  @param null|string|string[] $channels The channels to join on connect.
     */
    public function __construct(string $server, $username = null, $channels = null)
    {
        $this->connection = new IrcConnection($server);

        $this->user = $username === null ? null : new IrcUser($username);
        $this->channels = [];
        $this->messageEventHandlers = new EventHandlerCollection();

        if (!empty($channels)) {
            if (is_string($channels)) {
                $channels = [$channels];
            }

            foreach ($channels as $channel) {
                $this->channels[$channel] = new IrcChannel($channel);
            }
        }
    }

    /**
     *  Set the user credentials for the connections.
     *  When a connection is already open, this function can be used to change the nickname of the client.
     *
     *  @param IrcUser|string $user The user information.
     */
    public function setUser($user): void
    {
        if (is_string($user)) {
            $user = new IrcUser($user);
        }

        if ($this->connection->isConnected() && $this->user->nickname !== $user->nickname) {
            $this->send("NICK :$user->nickname");
        }

        $this->user = $user;
    }

    /**
     *  Connect to the irc server and start listening for messages.
     *
     *  @throws Exception if no user information is provided before connecting.
     */
    public function connect(): void
    {
        if (!$this->user) {
            throw new Exception('A nickname must be set before connecting to an irc server.');
        }

        if ($this->connection->isConnected()) {
            return;
        }

        $this->isAuthenticated = false;
        $this->connection->onData(function ($msg) {
            $this->handleIrcMessage($msg);
        });
        $this->connection->open();
    }

    /**
     *  Close the current connection, if any.
     */
    public function disconnect(): void
    {
        $this->connection->close();
    }

    /**
     *  Send a raw command string to the irc server.
     *
     *  @param string $command The full command string to send.
     */
    public function send(string $command): void
    {
        $this->connection->write($command);
    }

    /**
     *  Send a message to a channel or user.
     *  To send to a channel, make sure the `$target` starts with a `#`.
     *
     *  @param string $target The channel or user to message.
     *  @param string $message The message to send.
     */
    public function say(string $target, string $message): void
    {
        $this->send("PRIVMSG $target :$message");
    }

    /**
     *  Join an irc channel.
     *
     *  @param string $channel The name of the channel to join.
     */
    public function join(string $channel): void
    {
        $channel = $this->channelName($channel);
        $this->send("JOIN $channel");
        $this->getChannel($channel);
    }

    /**
     *  Part from an irc channel.
     *
     *  @param string $channel The name of the channel to leave.
     */
    public function part(string $channel): void
    {
        $channel = $this->channelName($channel);

        if (array_key_exists($channel, $this->channels)) {
            $this->send("PART $channel");
        }
    }

    /**
     *  Grab channel information by its name.
     *  This function makes sure the channel exists on this client first.
     *
     *  @param string $channel The name of this channel.
     *
     *  @return IrcChannel
     */
    public function getChannel(string $channel): IrcChannel
    {
        $channel = $this->channelName($channel);

        if (($this->channels[$channel] ?? null) === null) {
            $this->channels[$channel] = new IrcChannel($channel);
        }

        return $this->channels[$channel];
    }

    /**
     *  Return a list of all channels.
     *
     *  @return IrcChannel[]
     */
    public function getChannels(): array
    {
        return $this->channels;
    }

    /**
     *  Take actions required for received irc messages and invoke the correct event handlers.
     *
     *  @param IrcMessage $message The message object for the received line.
     */
    private function handleIrcMessage(IrcMessage $message): void
    {
        $message->handle($this);

        if (!$this->isAuthenticated && $this->user) {
            $this->send("USER {$this->user->nickname} * * :{$this->user->nickname}");
            $this->send("NICK {$this->user->nickname}");
            $this->isAuthenticated = true;
        }

        //$this->messageEventHandlers->invoke($message->command, [$message]);
    }

    /**
     *  Make sure all channel names have the same format.
     *
     *  @param string $channel The name of the channel to format.
     *
     *  @return string The formatted name.
     */
    private function channelName(string $channel): string
    {
        if ($channel[0] !== '#') {
            $channel = "#$channel";
        }

        return $channel;
    }
}
