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
    private $commandReg = '/^(convert|composite|mogrify)$/i';

    /**
     * @var string SEPARATOR
     */
    private $separator = '[sep]';

    /**
     * Building command by options
     *
     * @return string
     */
    public function build()
    {
        $count = count($this->options);
        $command = '';
        for($i=0; $i<$count; $i++) {
            $option = $this->options[$i];

            if ($option==$this->separator)
                $command .= "\\\n";

            $command .= ' ' . $option;
        }

        return $command;
    }

    /**
     * Set option
     *
     * @see http://www.graphicsmagick.org/GraphicsMagick.html
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function addOption(string $key, $value='')
    {
        $key = trim($key);
        if (empty($key))
            throw InvalidOptionException("Invalid option key" . __CLASS__ . ':' . __METHOD__, 500);

        $this->options[] = $this->normalizeOption($key, $value);
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
     * Add separator
     *
     * @return $this
     */
    public function addSeparator()
    {
        $this->options[] = $this->separator;
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
     * Validate command name
     *
     * @param string $name
     * @return bool
     */
    protected function validateCommandName($name)
    {
        return (preg_match($this->commandReg, $name)!=false);
    }

    /**
     * Normalize command name
     *
     * @param string $name
     * @return string
     */
    protected function normalizeName(string $name)
    {
        return strtolower(trim($name));
    }

    /**
     * Normalize option
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    protected function normalizeOption($key, $value)
    {
        $option = '-' . strtolower(trim($key));
        if (!empty($value))
            $option .= ' ' . $value;

        return $option;
    }
}
