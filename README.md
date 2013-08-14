Pushover
========

Simple pushover.net Library

# Example

```php
<?php
include __DIR__ . '/vendor/autoload.php';

$pushover = new \Scottymeuk\Pushover\Client([
    'token' => '',
    'user' => ''
]);

$send = $pushover->push([
    'message' => 'Testing'
]);
```
