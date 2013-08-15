Pushover
========

Simple pushover.net Library

# Example

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
