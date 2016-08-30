<?php

namespace iamgold\gmphp;

/**
 * This is a base calss of Command, all Command class must extends the class.
 */

class Command
{
    /**
     * Use command trait
     */
    use CommandTrait;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * Construct
     *
     * @param string $commandName
     */
    public function __construct($commandName=null)
    {
        if ($commandName!==null) {
            $this->setName($commandName);
        }
    }

    /**
     * Set command name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $name = $this->normalizeName($name);

        if (empty($name))
            throw new InvalidArgumentException("Undefined command name", 500);

        if (!$this->validateCommandName($name))
            throw new InvalidArgumentException("Not support command name ($name)", 501);

        $this->name = $name;
        return $this;
    }

    /**
     * Get command name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Prepare command
     *
     * @return string
     */
    protected function prepareCommand()
    {
        return $this->commandName . ' ' . $this->build();
    }
}
