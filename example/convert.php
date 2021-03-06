<?php

/**
 * This is an example for resing an image from 1024x768 to 800x600
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Prepare source file and destination file
$src = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Lighthouse.jpg';
$dest = __DIR__ . DIRECTORY_SEPARATOR . 'dest' . DIRECTORY_SEPARATOR . 'convert.result.jpg';

// create a graphicsmagic instance
$gm = new iamgold\gmphp\GraphicsMagick(['debug'=>true]);

// create resize command
$command = $gm->createCommand('convert')
              ->setSrcFile($src)
              ->addOption('resize', '800x600')
              ->addOption('background', 'black')
              ->addOption('quality', 92)
              ->setDestFile($dest)
              ->getRawCommand();

// execute resize command
if ($gm->execute($command)) {
    echo "\n execute ok \n";
} else {
    echo "\n execute fail \n result: \n " . $gm->getResult() . " \n";
}

$command = (new iamgold\gmphp\ConvertCommand)->setSrcFile($src)
                                             ->resize(100, 100, '>')
                                             ->crop(50, 50)
                                             ->setDestFile($dest.'_resize.jpg')
                                             ->getRawCommand();

// execute resize command
if ($gm->execute($command)) {
    echo "\n execute ok \n";
} else {
    echo "\n execute fail \n result: \n " . $gm->getResult() . " \n";
}
