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