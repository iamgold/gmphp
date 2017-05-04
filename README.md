# gmphp

> This is a lightweight library for manipulating graphics magick commands in PHP.

Getting start
=============

Step 1 Create garphic instance
------------------------------
```
$gm = new iamgold\gmphp\GraphicsMagick([]);
```
Step 2 Create resize command
----------------------------

```
$command = $gm->createCommand('convert')
              ->setSrcFile($src)
              ->addOption('resize', '800x600')
              ->addOption('background', 'black')
              ->addOption('quality', 92)
              ->setDestFile($dest)
              ->getRawCommand();
```
