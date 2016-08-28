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
     * Set option
     *
     * @see http://www.graphicsmagick.org/GraphicsMagick.html
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setOption(string $key, $value='')
    {
        $key = trim($key);
        if (empty($key))
            throw InvalidOptionException("Invalid option key" . __CLASS__ . ':' . __METHOD__, 500);

        $option = '-' . strtolower(trim($key));
        if (!empty($value))
            $option .= ' ' . $value;

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
    public function resetOptions()
    {
        $this->options = [];
        return $this;
    }

    /**
     * Set file option
     *
     * @param string $file
     * @return $this
     */
    public function setFile($file)
    {
        $this->option[] = trim($file);
        return $this;
    }
}
