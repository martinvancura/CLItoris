<?php 

namespace mvan\CLItoris;

class Output {

    /**
     * Desired maximum length of the line in terminal
     * @var $lineLength int
     */
    private $lineLength;

    /**
     * Desired text alling
     * @var $textAlign int
     */
    private $textAlign;

    public const ALIGN_RIGHT = 0; // Matches constant STR_PAD_LEFT
    public const ALIGN_LEFT = 1; // Matches constant STR_PAD_RIGHT
    public const ALIGN_CENTER = 2; // Matches constant STR_PAD_BOTH

    public function __construct($_lineLength = 80, $_align = self::ALIGN_LEFT) {
        $this->lineLength = $_lineLength;
        $this->textAlign = $_align;
    }

    public function printLn($message){
        print $message;
    }

    public function printColoredLn($message, $textColor, $backgroundColor=null, $strpad=false){
        $lines = [];

        if(strlen($message) > $this->lineLength) {
            $separatedLines = wordwrap($message,$this->lineLength,'{%line%}');
            $lines = explode('{%line%}', $separatedLines);
            
        } elseif(substr_count($message, PHP_EOL)>1) {
            $lines = explode(PHP_EOL, $message);
        }
        else {
            if($strpad){
                $string = str_pad($message, $this->lineLength, ' ', $this->textAlign);
            } else {
                $string = $message;
            }
            print $this->getColoredString($string, $textColor, $backgroundColor);
            return;
        }

        foreach($lines as $line) {
            if($strpad){
                $string = str_pad($line, $this->lineLength, ' ', $this->textAlign);
            } else {
                $string = $line;
            }
            print $this->getColoredString($string.PHP_EOL, $textColor, $backgroundColor);
        }
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
