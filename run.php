<?php

use League\Container\Container;
use Symfony\Component\Stopwatch\Stopwatch;

require 'vendor/autoload.php';

// Define test suite.
$ctorTests = function (Container $container) {
    foreach (range(1, 100000) as $i) {
        $container->get('Stubs\Foo');
    }
};

$callableTests = function (Container $container) {
    foreach (range(1, 50000) as $i) {
        $container->call('Stubs\foo');
    }
    foreach (range(1, 50000) as $i) {
        $container->call('Stubs\Qux::foo');
    }
};

// Create stopwatch.
$stopwatch = new Stopwatch();

// Test run: without using reflection.
echo 'Without reflection:'.PHP_EOL;
echo '100000 times object construction:'.PHP_EOL;
$stopwatch->start('ctor.without_reflection');

$container = new Container();
$container->add('Stubs\Foo')->withArgument('Stubs\Bar');
$container->add('Stubs\Bar')->withArgument('Stubs\Baz');
$container->add('Stubs\Baz')->withArgument('Stubs\Qux');
$container->add('Stubs\Qux', new \Stubs\Qux());

$ctorTests($container);
$event = $stopwatch->stop('ctor.without_reflection');
echo $event->getDuration().'ms'.PHP_EOL;

echo '100000 times function calling:'.PHP_EOL;
$stopwatch->start('callable.without_reflection');

$container = new Container();
$container->add('Stubs\Foo')->withArgument('Stubs\Bar');
$container->add('Stubs\Bar')->withArgument('Stubs\Baz');
$container->add('Stubs\Baz')->withArgument('Stubs\Qux');
$container->add('Stubs\Qux', new \Stubs\Qux());

$container->invokable('Stubs\foo')->withArgument('Stubs\Foo')->withArgument(false);
$callableTests($container);
$container->invokable('Stubs\Qux::foo')->withArgument('Stubs\Foo')->withArgument(false);
$callableTests($container);

$event = $stopwatch->stop('callable.without_reflection');
echo $event->getDuration().'ms'.PHP_EOL;


// Test run: using reflection.
echo PHP_EOL;
echo 'With reflection:'.PHP_EOL;
echo '100000 times constructor reflection:'.PHP_EOL;
$stopwatch->start('ctor.with_reflection');

$container = new Container();
$ctorTests($container);

$event = $stopwatch->stop('ctor.with_reflection');
echo $event->getDuration().'ms'.PHP_EOL;

echo '100000 times function reflection:'.PHP_EOL;
$stopwatch->start('callable.with_reflection');

$container = new Container();
$callableTests($container);

$event = $stopwatch->stop('callable.with_reflection');
echo $event->getDuration().'ms'.PHP_EOL;
