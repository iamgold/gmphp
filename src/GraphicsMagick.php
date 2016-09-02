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
     * @var bool $debug default: false
     */
    public $debug = false;

    /**
     * @var string $result
     */
    public $result = '';

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
     * create command
     *
     * @param string $name
     * @return $this
     * @throws InvalidArgumentException
     */
    public function createCommand(string $name)
    {
        $className = '\\iamgold\\gmphp\\' . ucfirst($name) . 'Command';
        if (!class_exists($className))
            throw new \Exception("Unknown class ($className). " . __METHOD__, 500);

        return new $className;
    }

    /**
     * Exceute a command string
     *
     * @param string $command
     * @return bool
     */
    public function execute(string $command)
    {
        $cmd = $this->bin . ' ' . $command . ' 2>&1';

        if ($this->debug)
            echo "\n===== Run command =====\n  $cmd\n========= end =========\n";

        $this->result = shell_exec($cmd);
        return (empty($this->result));
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

    /**
     * Get executed result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }
}
