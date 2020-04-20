<?php 

namespace mvan\CLItoris;

use mvan\CLItoris\Color;

class Output {

    public function printColoredLn($message, $textColor, $backgroundColor=null){
        print $this->getColoredString($message, $textColor, $backgroundColor);
    }

    private function getColoredString($string, $textColor, $backgroundColor = null) {
        $str = "";
        $str .= "\033[" . $textColor . "m";
            
        if ($backgroundColor) {
            $str .= "\033[" . $backgroundColor . "m";
        }
        
        $str .=  $string . "\033[0m";
        return $str;
    }
}
