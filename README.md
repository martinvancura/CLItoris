### CLItoris - Light weight framework to perform CLI tasks in PHP

This library help with a structure of command line tasks in your project. It also allows you to print colored and formatted messages to terminal output. **Enjoy simplicity!**

Features
--------
 * Routing and executing your CLI tasks
 * Parsing given arguments to stdClass
 * Tools for colored and formatted text output to terminal
 
Setup
-----

Add the library to your `composer.json` file in your project:

```javascript
{
  "require": {
      "mvan/clitoris": "1.*"
  }
}
```

Use [composer](http://getcomposer.org) to install the library:

```bash
$ php composer.phar install
```

Composer will install CLItoris inside your vendor folder. Then you can add the following to your
.php files to use the library with Autoloading.

```php
require_once __DIR__ . '/vendor/autoload.php';
```

Alternatively, use composer on the command line to require and install CLItoris:

```
$ php composer.phar require mvan/clitoris:1.*
```

### Minimum Requirements
 * PHP 7

Usage
-----
### Define tasks
```php
<?php
date_default_timezone_set("Europe/Prague");

require_once '../src/Dispatcher.php';
require_once '../src/BaseTask.php';
require_once '../src/Color.php';
require_once '../src/Output.php';
require_once 'Demo.php';

use mvan\CLItoris\Dispatcher;

$demo = new Dispatcher($argv);
$demo->addTask('hello-world', mvan\CLItoris\tasks\Demo::class, 'helloWorld', 'Hello world! This is a dummy task where you can palay with parameters in format php yourFile.php param:value');
$demo->addTask('rainbow', mvan\CLItoris\tasks\Demo::class, 'rainbow', 'Shows all available text colors.');
$demo->dispatch();
```
### Implement them
```php
<?php

namespace mvan\CLItoris\tasks;

use mvan\CLItoris\BaseTask, mvan\CLItoris\Color, mvan\CLItoris\Output;

/**
 *
 * @author Martin Vancura <mv@mvan.eu>
 */

class Demo extends BaseTask {
    public function helloWorld() {
        $out = new Output();

        if(!empty((array)$this->args)){
            $out->printColoredLn("Arguments to your task are: ".PHP_EOL, Color::TXT_LIGHT_PURPLE);
            var_dump($this->args);
        } else {
            $out->printColoredLn("You have not used any arguments. Try some by typing ", Color::TXT_LIGHT_PURPLE);
            $out->printColoredLn("$ php executable.php hello-world argument:value yay:3 ", Color::TXT_LIGHT_GREEN);
            $out->printColoredLn("to the terminal.".PHP_EOL, Color::TXT_LIGHT_PURPLE);
        }
    }

    public function rainbow(){
        /**
         * Really long text will be automatically wrapped wrapped after certain number of characters if you want.
         * Available text align: Output::ALIGN_CENTER, Output::ALIGN_LEFT, Output::ALIGN_RIGHT
         */
        $longTextOut = new Output(80,Output::ALIGN_CENTER);
        $longTextOut->printColoredLn('sakldj laskjdl alskjd alksjd alksjd laksj dlkaj slkdja lskjdl ajskd lajsd laksjd lakjs dlajksdl akjslkdj alksjdl alskjd alksjd lajsdlk jlkqjlk wjelqkwjel qwkje qlkwje lqwjke qlwkje qlwkje qlkwje lqkwje lqwkje lqwkje qlwkje qlkwje lqkwje lkqjwelqjkw elkqjw elkqwje ',Color::TXT_LIGHT_GRAY, Color::BG_BLUE,true);

        $out = new Output();

        /**
         * You can print line without color decorator
         */
        $out->printLn(PHP_EOL);

        /**
         * You can use different colors on the same line
         */
        $out->printColoredLn('Blue text next to the ', Color::TXT_BLUE);
        $out->printColoredLn('cyan text'.PHP_EOL, Color::TXT_CYAN);
        $out->printLn(PHP_EOL);

        /**
         * Or use any available color combination
         */
        $out->printColoredLn('Dark grey text'.PHP_EOL, Color::TXT_DARK_GRAY);
        $out->printColoredLn('Green text'.PHP_EOL, Color::TXT_GREEN);
        $out->printColoredLn('Light blue text'.PHP_EOL, Color::TXT_LIGHT_BLUE);
        $out->printColoredLn('Light cyan text'.PHP_EOL, Color::TXT_LIGHT_CYAN);
        $out->printColoredLn('Light grey text'.PHP_EOL, Color::TXT_LIGHT_GRAY);
        $out->printColoredLn('Light green text'.PHP_EOL, Color::TXT_LIGHT_GREEN);
        $out->printColoredLn('Light purple text'.PHP_EOL, Color::TXT_LIGHT_PURPLE);
        $out->printColoredLn('Light red text'.PHP_EOL, Color::TXT_LIGHT_RED);
        $out->printColoredLn('Purple text'.PHP_EOL, Color::TXT_PURPLE);
        $out->printColoredLn('Red text'.PHP_EOL, Color::TXT_RED);
        $out->printColoredLn(' White text on green background '.PHP_EOL, Color::TXT_WHITE, Color::BG_GREEN);
        $out->printColoredLn('Yellow text'.PHP_EOL, Color::TXT_YELLOW);
        $out->printColoredLn(' Black text on yellow background '.PHP_EOL, Color::TXT_BLACK, Color::BG_YELLOW);
        $out->printColoredLn(' Light grey text on blue background '.PHP_EOL, Color::TXT_LIGHT_GRAY, Color::BG_BLUE);
    }
}
```