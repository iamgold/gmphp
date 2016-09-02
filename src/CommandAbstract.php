<?php

namespace iamgold\gmphp;

/**
 * This is an abstract class of Command that represents some common methods
 * and properties.
 */

abstract class CommandAbstract
{
    /**
     * Use command trait
     */
    use CommandTrait;

    /**
     * @var string $name means command name
     */
    public $name;

    /**
     * @var GraphicsMagick $gm
     */
    public $gm;

    /**
     * Construct
     *
     * @param GraphicsMagick|null $gm
     */
    public function __construct($gm=null)
    {
        if ($gm!==null) {
            if ($gm instanceof GraphicsMagick)
                $this->gm = &$gm;
            else
                throw new InvalidArgumentException("Invalid class of GraphicsMagick. " . __METHOD__, 500);
        }

        if (!$this->validateCommandName($this->name)) {
            throw new InvalidPropertyException("Invalid command name ({$this->name}). " . __METHOD__, 501);
        }
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
     * Get raw command by parsing options
     *
     * @return string
     */
    public function getRawCommand()
    {
        return $this->name . ' ' . implode(' ', $this->options);
    }
}
