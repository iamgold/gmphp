<?php

/**
 * This is an example for resing an image from 1024x768 to 800x600
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Prepare source file and destination file
$src = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'height_large.jpg';
$dest = __DIR__ . DIRECTORY_SEPARATOR . 'dest' . DIRECTORY_SEPARATOR . 'height_large_result.jpg';

// create a graphicsmagic instance
$gm = new iamgold\gmphp\GraphicsMagick(['debug'=>true]);

// create resize command
$command = (new iamgold\gmphp\ConvertCommand)->setSrcFile($src)
                                             ->resize(1280, 960)
                                             ->setDestFile($dest)
                                             ->getRawCommand();

// execute resize command
if ($gm->execute($command)) {
    echo "\n execute ok \n";
} else {
    echo "\n execute fail \n result: \n " . $gm->getResult() . " \n";
}
