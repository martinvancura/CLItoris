<?php
namespace CLItoris;

/**
 * CLItorisTask
 * Extension for the CLI task classes to inject arguments from command line
 * @author Martin Vancura <mv@mvan.eu>
 */

abstract class CLItorisTask {
    /**
     * @var stdClass
     */
    protected $args;

    /**
     * CLItorisTask constructor.
     * @param stdClass $args
     */
    public function __construct(\stdClass $args) {
        $this->args = $args;
    }
}