<?php

namespace Scottymeuk\Pushover;

class Client
{
    private $url = 'https://api.pushover.net/1/messages.json';

    private $token = null;
    private $user = null;

    private $data = array();

    public function __construct($options = array())
    {
        if (! isset($options['token']) || ! isset($options['user'])) {
            throw new Exception('You must supply a token and user');
        }

        $this->token = $options['token'];
        $this->user = $options['user'];

        if (isset($options['url'])) {
            $this->url = $options['url'];
        }
    }

    public function push(Array $data = array())
    {
        $this->data = $data;
        if (! isset($this->data['message'])) {
            throw new Exception('You must supply a message');
        }

        return $this->send();
    }

    private function send()
    {
        $data = array_merge($this->data, [
            'token' => $this->token,
            'user' => $this->user
        ]);

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
