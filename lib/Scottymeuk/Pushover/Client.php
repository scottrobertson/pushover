<?php

namespace Scottymeuk\Pushover;

class Client
{
    /**
     * The pushover.net endpoint
     * @var string
     */
    public $pushover_url = 'https://api.pushover.net/1/messages.json';

    /**
     * The token to auth requests with
     * @var string
     */
    public $token;
    public $data = array();

    /**
     * Class constructor to gather token and url
     * @param array $options Array containing token and url
     */
    public function __construct($options = array())
    {
        if (! isset($options['token'])) {
            throw new Exception('You must supply a token');
        }

        $this->token = $options['token'];
        if (isset($options['url'])) {
            $this->pushover_url = $options['url'];
        }
    }

    /**
     * Magic __set method
     * @param string $key  The variable name
     * @param string|array $data The data to store against the key
     */
    public function __set($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * Magic __get method
     * @param  string $key Which variable should we return?
     * @return sting|array      The data to return
     */
    public function __get($key)
    {
        if (! isset($this->data[$key])) {
            return null;
        }

        return $this->data[$key];
    }

    /**
     * isset() magic method
     * @param  string  $key Variable name
     * @return boolean      Does it exist?
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Push to multiple users
     * @param  Array  $users Array of users
     * @return bool        Did any of them fail?
     */
    public function pushMultiple(Array $users)
    {
        $failed = array();
        foreach ($users as $user) {
            $push = $this->push($user);
            if (! $push) {
                $failed[] = $user;
            }
        }

        return !count($failed);
    }

    /**
     * Push a notification to a specific user
     * @param  string $user The user token
     * @return bool       Did the notification send or not?
     */
    public function push($user)
    {
        if (! isset($this->data['message'])) {
            throw new Exception('You must supply a message');
        }

        $data = array_merge($this->data, array(
            'token' => $this->token,
            'user' => $user
        ));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->pushover_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return isset($result['status']) && $result['status'] == 1;
    }
}
