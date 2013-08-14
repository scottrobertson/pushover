<?php

namespace Scottymeuk\Pushover\Test;
use Scottymeuk\Pushover\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $client = new Client(array(
            'token' => ''
        ));

        $this->assertTrue(is_object($client));
    }

    public function testInitWithUrl()
    {
        $client = new Client(array(
            'token' => '',
            'url' => 'http://google.com'
        ));

        $this->assertTrue(is_object($client));
        $this->assertEquals('http://google.com', $client->pushover_url);
    }

    public function testInitFail()
    {
        try {
            $client = new Client();
        } catch (\Scottymeuk\Pushover\Exception $e) {
            return;
        }
    }

    public function testSetAndGet()
    {
        $client = new Client(array(
            'token' => ''
        ));
        $client->message = 'testing';

        $this->assertEquals('testing', $client->message);
    }

    public function testSetAndGetNull()
    {
        $client = new Client(array(
            'token' => ''
        ));

        $this->assertNull($client->message);
    }

    public function testIsset()
    {
        $client = new Client(array(
            'token' => ''
        ));

        $this->assertFalse(isset($client->message));

        $client->message = 'testing';
        $this->assertTrue(isset($client->message));

    }

    public function testPushNoMessage()
    {
        $client = new Client(array(
            'token' => ''
        ));

        $this->assertTrue(is_object($client));

        try {
            $push = $client->push('test');
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
        $client->message = 'hi';
        $push = $client->push('test');
    }
}
