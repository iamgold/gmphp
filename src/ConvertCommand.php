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
     * Set quality option
     *
     * @param int $quality
     * @param bool $isPNG
     * @return $this
     */
    public function quality(int $quality, $isPNG=false)
    {
        if ($isPNG) {
            if ($quality<1)
                $quality = 1;

            if ($quality>=10)
                $quality = round($quality/10);
        }

        $this->addOption('quality', $quality);
        return $this;
    }

    /**
     * Resize an image using resize algorithm
     */
    public function resize(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('resize', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Create an thumbnail image using thumbnail algorithm
     */
    public function thumbnail(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('thumbnail', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Scale an image using scale algorithm
     */
    public function scale(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('scale', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Resize an image using sample algorithm
     */
    public function sample(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('sample', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Crop an image
     */
    public function crop(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('crop', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Crop an image using extent algorithm
     */
    public function extent(int $width, int $height, $fit='', $offset='')
    {
        $this->resizeImage('extent', $width, $height, $fit, $offset);
        return $this;
    }

    /**
     * Resize or crop an image
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
    protected function resizeImage(string $algorithm, int $width, int $height, $fit='', $offset='')
    {
        if (preg_match('/^(resize|thumbnail|scale|sample|crop|extent)$/', $algorithm)==false)
            throw new InvalidArgumentException("Not support argument of algorithm ($algorithm). " . __CLASS__ . ':' . __METHOD__, 500);

        if (!$this->validateFit($fit)) {
            throw new InvalidArgumentException("Not support argument of fit ($fit). " . __CLASS__ . ':' . __METHOD__, 501);
        } else {
            if (!empty($fit) && ($fit=='<' || $fit=='>'))
                $fit = '\\' . $fit;
        }

        if (!$this->validateOffset($offset)) {
            throw new InvalidArgumentException("Not support argument of offset ($offset). " . __CLASS__ . ':' . __METHOD__, 502);
        }

        if ($fit==='%') {
            if ($width>0 && $height>0)
                throw new InvalidArgumentException("Just setting an value of width or height when the fit mode is (%)." . __CLASS__ . ':' . __METHOD__, 503);

            $percent = ($width>0) ? $width : $height;
            $value = $percent . $fit;
        } else {
            $value = sprintf('%sx%s%s%s', ($width>0)?$width:'', ($height>0)?$height:'', $offset, $fit);
        }

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
