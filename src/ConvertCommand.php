<?php

namespace iamgold\gmphp;

/**
 * This class is used to mapulate all options of convert.
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
     * @param int $width
     * @param int $height
     * @param string $fit
     * values:
     *      !: force size
     *      >: less than original size and must escaping string ex: \>
     *      <: more than original size and must escaping string ex: \<
     *      ^: match, resize the image based on the smallest fitting dimension
     *      %: resize by percent
     */
    public function resize(int $width, int $height, $fit='')
    {
        if (!empty($fit) && preg_match('/^[\!\>\<\^%]{1}$/', $fit)===false) {
            throw new InvalidArgumentException("Not support argument of fit ($fit)", 500);
        }

        $value = sprintf('%sx%s%s', $width, $height, $fit);
        $this->addOption('resize', $value);

        return $this;
    }
}
