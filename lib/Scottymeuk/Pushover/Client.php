<?php

namespace Scottymeuk\Pushover;

class Client
{
    public $url = 'https://api.pushover.net/1/messages.json';
    public $token = null;
    public $data = array();

    public function __construct($options = array())
    {
        if (! isset($options['token'])) {
            throw new Exception('You must supply a token');
        }

        $this->token = $options['token'];
        if (isset($options['url'])) {
            $this->url = $options['url'];
        }
    }

    public function __set($key, $data)
    {
        $this->data[$key] = $data;
    }

    public function __get($key)
    {
        if (! isset($this->data[$key])) {
            return null;
        }

        return $this->data[$key];
    }

    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

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
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return isset($result['status']) && $result['status'] == 1;
    }
}
