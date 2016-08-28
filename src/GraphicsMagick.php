<?php

namespace iamgold\gmphp;

/**
 * This class is used to create a command for processing
 * image using Graphics magick.
 */

class GraphicsMagick
{
    /**
     * @var string $binary abslute path of binary command
     */
    public $bin = '/usr/bin/gm';

    /**
     * @var array $commands
     */
    private $commands = [];

    /**
     * @var int $currentCmdIndex
     */
    private $currentCmdIndex = 0;

    /**
     * Construct
     *
     * @param array $config inlucdes all custom options
     */
    public function __construct(array $config)
    {
        if (count($config)>0) {
            foreach($config as $key=>$value)
                $this->$key = $value;
        }
    }

    /**
     * Create a command.
     *
     * @param string $command if the value is default value[null], will build command
     * @return $this
     */
    public function createCommand(string $command)
    {}
}
