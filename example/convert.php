<?php

/**
 * This is an example for resing an image from 1024x768 to 800x600
 */

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Prepare source file and destination file
$src = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Lighthouse.jpg';
$dest = __DIR__ . DIRECTORY_SEPARATOR . 'dest' . DIRECTORY_SEPARATOR . 'convert.result.jpg';

// create a graphicsmagic instance
$gm = new iamgold\gmphp\GraphicsMagick;

// create resize command
$command = $gm->beginCommand('convert')
              ->setSrcFile($src)
              ->addOption('resize', '800x600')
              ->addOption('background', 'black')
              ->addOption('quality', 92)
              ->setDestFile($dest)
              ->setDebug(true)
              ->createCommand();

// execute resize command
if ($gm->execute($command, $result)) {
    echo "\n execute ok \n";
} else {
    echo "\n execute fail \n result: \n $result \n";
}
