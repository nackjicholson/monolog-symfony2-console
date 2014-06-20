monolog-symfony2-console
========================

Monolog for Symfony2 Console Component output.

Why? Because `StreamHandler` to `php://stdout` is ugly, and Symfony2 Console Output is pretty.

Basic Usage:

```php
$output = new \Symfony\Component\Console\Output\ConsoleOutput();

$consoleFormatter = new \Nack\Monolog\Formatter\Symfony2ConsoleFormatter();

$consoleHandler = new \Nack\Monolog\Handler\Symfony2ConsoleHandler($output);
$consoleHandler->setFormatter($consoleFormatter);

$logger = new \Monolog\Logger('channel');
$logger->pushHandler($consoleHandler);

$logger->critical('bagel'); // underlined white text on red background.
```