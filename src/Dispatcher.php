<?php

namespace mvan\CLItoris;
use mvan\CLItoris\Color, mvan\CLItoris\Output;
/**
 * a simple library for handling CLI tasks in PHP.
 *
 * @author Martin Vancura <mv@mvan.eu>
 */

class Dispatcher {
    /**
     * @var string
     */
    private $task;

    /**
     * @var BaseTask[]
     */
    private $tasks;

    /**
     * @var stdClass
     */
    private $variables;

    /**
     * Dispatcher
     * @param array $argv
     */
    function __construct($argv) {
        $this->task = 'help';
        $this->tasks = array();

        $this->initArgs($argv);
    }

    /**
     * @param string $taskName - name of the task called from CLI
     * @param string $className - class name which take care of the task
     * @param string $method - method of the class which should be executed to accomplish the task
     * @param string $taskHelp - description of the task
     */
    public function addTask($taskName, $className, $method, $taskHelp) {
        $this->tasks[$taskName] = (object) [
            'class' => $className,
            'method' => $method,
            'taskHelp' => $taskHelp
        ];
    }

    /**
     * Execution of the task
     */
    public function dispatch() {
        $action = (isset($this->tasks[$this->task])) ? $this->tasks[$this->task] : null;

        if($this->task == 'help' || $this->task == '--help') {
            $this->renderHelp();
            exit;
        }

        if(!$action) {
            $this->renderHelp(true);
            exit;
        }

        try {
            $class = new $action->class($this->variables);
            $class->{$action->method}();
            echo "\x07";
            exit;
        } catch (\Exception $e) {
            print $e->getMessage();
            exit(0);
        }
    }

    /**
     * Generate help for the CLI tasks
     * @param boolean $forced
     */
    private function renderHelp($forced = false) {
        $out = new Output();
        $out->printColoredLn("CLItoris Help \n", Color::TXT_LIGHT_PURPLE);

        if($forced) {
            print "There is no such task: {$this->task} \n";
        }

        print "Implemented tasks in this project are: \n";

        foreach($this->tasks as $taskName => $task) {
            print "\t{$taskName}\t {$task->taskHelp}\n";
        }
    }

    /**
     * Parser for the CLI  input
     * @param array $argv
     */
    private function initArgs($argv) {
        $varArr = [];

        foreach ($argv as $key=>$arg) {
            if($key == 1) {
                $this->task = $arg;
            }

            if($key > 1) {
                $this->parseVariable($varArr, $arg);
            }
        }

        $this->variables = (object) $varArr;
    }

    /**
     * CLI arguments parser
     * @param array $varArr
     * @param string $arg
     * @throws \Exception
     */
    private function parseVariable(&$varArr, $arg) {
        $e = explode(':', $arg);

        if(count($e) < 2) {
            throw new \Exception("CLItoris input error! Valid use is php script.php task variable:value... You have :".$arg." in the variable list");
        }

        $varArr[$e[0]] = $e[1];
    }
}