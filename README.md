monolog-symfony2-console
========================

Monolog for Symfony2 Console Component output.

Why? Because `StreamHandler` to `php://stdout` is ugly, and Symfony2 Console Output is pretty.

### Basic Usage:

```php
$output = new \Symfony\Component\Console\Output\ConsoleOutput();

$consoleFormatter = new \Nack\Monolog\Formatter\Symfony2ConsoleFormatter();

$consoleHandler = new \Nack\Monolog\Handler\Symfony2ConsoleHandler($output);
$consoleHandler->setFormatter($consoleFormatter);

$logger = new \Monolog\Logger('channel');
$logger->pushHandler($consoleHandler);

$logger->debug('Debug Life');
$logger->info('Just a little FYI');
$logger->notice('A little something to see here');
$logger->warning('Pay attention, be careful');
$logger->error('Your program broke, it happens');
$logger->critical('Oh my goodness, someone do something!');
$logger->emergency('It is all on fire! You may be fired!');
```

![example](https://cloud.githubusercontent.com/assets/365247/3337030/55beb6e2-f842-11e3-85c2-b90a5d2fbf13.gif)