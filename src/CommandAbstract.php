<?php

namespace iamgold\gmphp;

/**
 * This is an abstract class of Command that represents some common methods
 * and properties.
 */

abstract class CommandAbstract implements CommandInterface
{
    /**
     * @var string $commandName
     */
    protected $commandName;

    /**
     * @var iamgold\gmphp\Command $previousCommand
     */
    private $command = null;

    /**
     * Construct
     *
     * @param mixed
     */
    public function __construct($command=null)
    {
        if ($command!==null) {
            if ($command instanceof \iamgold\gmphp\Command)
                $this->command = &$command;
            else
                throw new InvalidArgumentException("Invalid class of command. " . __CLASS__ . ':' . __METHOD__, 500);
        }

        if ($this->commandName===null)
            throw new InvalidPropertyException("The property of commandName undefined. " . __CLASS__ . ':' . __METHOD__, 501);
    }

    /**
     * Build command
     *
     * @return string
     */
    public function buildCommand()
    {
        $command = $this->prepareCommand();
        if ($this->command===null)
            return $command;

        return $this->command->buildCommand() . "\\\n" . $command;
    }

    /**
     * Prepare command
     *
     * @return string
     */
    abstract protected function prepareCommand();
}
