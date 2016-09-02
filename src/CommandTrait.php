<?php

namespace iamgold\gmphp;

/**
 * This trait reprents serverl features for processing graphics image option.
 */

Trait CommandTrait
{
    /**
     * @var array $options
     */
    protected $options = [];

    /**
     * @var string $commandReg
     */
    public $commandReg = '/^(convert|composite|mogrify)$/';

    /**
     * Set option
     *
     * @see http://www.graphicsmagick.org/GraphicsMagick.html
     * @param string $key
     * @param string $value
     * @param bool $autoDash means automatically prepending dash to key.
     * @return $this
     */
    public function addOption(string $key, $value='', $autoDash=true)
    {
        $key = strtolower(trim($key));
        if (empty($key))
            throw new InvalidOptionException("Invalid option key. " . __METHOD__, 500);

        $option = $key;
        if ($autoDash)
            $option = '-' . $key;

        if (!empty($value)) {
            $value = (string) $value;
            $option .= ' ' . $value;
        }

        $this->options[] = $option;
        return $this;
    }

    /**
     * Get option
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Reset options
     *
     * @return $this
     */
    public function reset()
    {
        $this->options = [];
        return $this;
    }

    /**
     * Set source file
     *
     * @param string $filepath
     * @return $this
     */
    public function setSrcFile($filepath)
    {
        return $this->addFile($filepath);
    }

    /**
     * Set destination file
     *
     * @param string $filepath
     * @return $this
     */
    public function setDestFile($filepath)
    {
        return $this->addFile($filepath);
    }

    /**
     * Set file option
     *
     * @param string $file
     * @return $this
     */
    public function addFile($file)
    {
        $this->options[] = trim($file);
        return $this;
    }

    /**
     * Set command name regular expression
     *
     * @param srtring $regularExpression
     * @return $this
     */
    public function setCommandRegularExpression(string $regularExpression)
    {
        $this->commandReg = $regularExpression;
        return $this;
    }

    /**
     * Validate command name
     *
     * @param string $name
     * @return bool
     */
    protected function validateCommandName($name)
    {
        return (preg_match($this->commandReg, $name)!=false);
    }
}
