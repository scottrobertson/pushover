Pushover
========

[![Build Status](https://travis-ci.org/scottrobertson/pushover.png?branch=master)](https://travis-ci.org/scottrobertson/pushover)
[![Total Downloads](https://poser.pugx.org/scottymeuk/pushover/d/total.png)](https://packagist.org/packages/scottymeuk/pushover)
[![Version](https://poser.pugx.org/scottymeuk/pushover/version.png)](https://packagist.org/packages/scottymeuk/pushover)

A simple PHP library for pushover.net. It essentially just wraps curl, and makes it a bit easier to send push notifications. The main reason for building this was to allow pushing to mulitple users easily.

## Requirements
 - PHP >= 5.3.3
 - Curl PHP Driver

## Example

```php
<?php
include __DIR__ . '/vendor/autoload.php';

$pushover = new \Scottymeuk\Pushover\Client([
    'token' => '',
]);
$pushover->message = 'testing';

// Push Single
$push = $pushover->push($token);

// Push Multiple
$push = $pushover->pushMultiple([
    $token1,
    $token2
]);
```


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/scottrobertson/pushover/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

