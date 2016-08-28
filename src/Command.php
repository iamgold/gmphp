<?php

namespace iamgold\gmphp;

/**
 * This is a base calss of Command, all Command class must extends the class.
 */

class Command extends CommandAbstract
{
    /**
     * Use command trait
     */
    use CommandTrait;

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
