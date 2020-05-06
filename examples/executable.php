<?php
date_default_timezone_set("Europe/Prague");

require_once '../src/Dispatcher.php';
require_once '../src/BaseTask.php';
require_once '../src/Color.php';
require_once '../src/Output.php';
require_once '../src/Table.php';
require_once 'Demo.php';

use mvan\CLItoris\Dispatcher;

$demo = new Dispatcher($argv);
$demo->addTask('hello-world', mvan\CLItoris\tasks\Demo::class, 'helloWorld', 'Hello world! This is a dummy task where you can palay with parameters in format php yourFile.php param:value');
$demo->addTask('rainbow', mvan\CLItoris\tasks\Demo::class, 'rainbow', 'Shows all available text colors.');
$demo->addTask('tables', mvan\CLItoris\tasks\Demo::class, 'tables', 'Shows work with tables.');
$demo->dispatch();