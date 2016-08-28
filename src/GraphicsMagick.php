<?php

namespace iamgold\gmphp;

/**
 * This class is used to create a command for processing
 * image using Graphics magick.
 */

class GraphicsMagick
{
    /**
     * use Command features
     */
    use CommandTrait;

    /**
     * @var string $binary abslute path of binary command
     */
    public $bin = '/usr/bin/gm';

    /**
     * @var bool $debug default: false
     */
    public $debug = false;

    /**
     * Construct
     *
     * @param array $config inlucdes all custom options
     */
    public function __construct($config=[])
    {
        if (is_array($config) && count($config)>0) {
            foreach($config as $key=>$value)
                $this->$key = $value;
        }
    }

    /**
     * Create commmand
     *
     * @param iamgold\gmphp\Command $command
     * @return string
     */
    public function createCommand($command=null)
    {
        $rawCommand = ($command instanceof Command)
                            ? $command->buildCommand()
                                : $this->build();

        return $rawCommand;
    }

    /**
     * Exceute a command string
     *
     * @param string $command
     * @param string $result call by reference
     * @return bool
     */
    public function execute(string $command, &$result)
    {
        $cmd = $this->bin . ' ' . $command;

        if ($this->debug)
            echo "\n===== Run command =====\n  $cmd\n========= end =========\n";

        $result = shell_exec($cmd);

        return (empty($result));
    }

    /**
     * Set debug mode
     *
     * @param bool $mode
     */
    public function setDebug($mode)
    {
        $this->debug = ($mode===true) ? true : false;

        return $this;
    }
}
