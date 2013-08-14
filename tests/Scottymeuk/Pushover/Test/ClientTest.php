<?php

namespace Scottymeuk\Pushover\Test;
use Scottymeuk\Pushover\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $client = new Client(array(
            'token' => '',
            'user' => ''
        ));

        $this->assertTrue(is_object($client));
    }

    public function testInitWithUrl()
    {
        $client = new Client(array(
            'token' => '',
            'user' => '',
            'url' => 'http://google.com'
        ));

        $this->assertTrue(is_object($client));
        $this->assertEquals('http://google.com', $client->url);
    }

    public function testInitFail()
    {
        try {
            $client = new Client();
        } catch (\Scottymeuk\Pushover\Exception $e) {
            return;
        }
    }

    public function testPushNoMessage()
    {
        $client = new Client(array(
            'token' => '',
            'user' => ''
        ));

        $this->assertTrue(is_object($client));

        try {
            $push = $client->push();
        } catch (\Scottymeuk\Pushover\Exception $e) {
            return;
        }
    }

    public function testPush()
    {
        $client = new Client(array(
            'token' => '',
            'user' => ''
        ));

        $this->assertTrue(is_object($client));

        $push = $client->push(array(
            'message' => 'test'
        ));
    }
}
