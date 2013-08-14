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

$token = '';
$push = $pushover->push($token);
```
