<?php

namespace iamgold\gmphp;

/**
 * This class is used to mapulate all options of convert.
 *
 * @since 1.1.0
 */

class ConvertCommand extends Command
{
    /**
     * inheritdoc
     */
    public $name = 'convert';

    /**
     * Resize an image
     *
     * @param string $algorithm values: resize, thumbnail, scale, sample, crop, extent
     * @param int $width
     * @param int $height
     * @param string $fit
     * values:
     *      !: force size
     *      >: less than original size and must escaping string ex: \>
     *      <: more than original size and must escaping string ex: \<
     *      ^: match, resize the image based on the smallest fitting dimension
     *      %: resize by percent
     * @param string $offset
     * @see http://www.graphicsmagick.org/GraphicsMagick.html#details-resize
     * @since 1.1.1
     * @return $this
     */
    public function resizeImage(string $algorithm, int $width, int $height, $fit='', $offset='')
    {
        if (preg_match('/^(resize|thumbnail|scale|sample|crop|extent)$/', $algorithm)==false)
            throw new InvalidArgumentException("Not support argument of algorithm ($algorithm). " . __CLASS__ . ':' . __METHOD__, 500);

        if (!$this->validateFit($fit)) {
            throw new InvalidArgumentException("Not support argument of fit ($fit). " . __CLASS__ . ':' . __METHOD__, 501);
        }

        if (!$this->validateOffset($offset)) {
            throw new InvalidArgumentException("Not support argument of offset ($offset). " . __CLASS__ . ':' . __METHOD__, 502);
        }

        $value = sprintf('%sx%s%s%s', $width, $height, $offset, $fit);
        $this->addOption($algorithm, trim($value));

        return $this;
    }

    /**
     * Validate fit mode
     *
     * @param string $mode
     * @return bool
     */
    private function validateFit(string $fit)
    {
        $fit = trim($fit);
        if (empty($fit))
            return true;

        return (preg_match('/^[\!\>\<\^%]{1}$/', $fit)!=false);
    }

    /**
     * Validate offset
     *
     * @param string $offset
     * @return bool
     */
    private function validateOffset(string $offset)
    {
        $offset = trim($offset);
        if (empty($offset))
            return true;

        return (preg_match('/^[\+-]{1}\d+[\+-]\d+$/', $offset)!=false);
    }
}
