<?php

namespace Scottymeuk\Pushover;

class Client
{

    /**
     * Protected
     */
    protected $api_url = 'https://api.pushover.net/1/messages.json';


    /**
     * Data Attributes
     * @var array
     */
    protected $data = array();


    /**
     * Class constructor to gather token and url
     * @param array $options Array containing token and url
     */
    public function __construct($options = array())
    {

        // Set token
        if (! isset($options['token'])) {
            throw new Exception('You must supply a token');
        }
        $this->token = $options['token'];

        // Set URL
        if (isset($options['api'])) {
            $this->api_url = $options['api'];
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
     * Get token
     */
    public function getToken()
    {
        return $this->data['token'];
    }


    /**
     * Get URL
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }


    /**
     * Push to multiple users
     * @param  Array  $users Array of users
     * @return bool        Did any of them fail?
     */
    public function pushMultiple(array $users)
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

        // Fields to send
        $data = array_merge($this->data, array(
            'user' => $user,
        ));

        // Send data to API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->api_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return isset($result['status']) && (int) $result['status'] === 1;
    }
}
