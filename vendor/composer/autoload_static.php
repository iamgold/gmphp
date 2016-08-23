<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a1a0b56cea11b2a3d5f3d812b136f64
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'iamgold\\gmphp\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'iamgold\\gmphp\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a1a0b56cea11b2a3d5f3d812b136f64::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a1a0b56cea11b2a3d5f3d812b136f64::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
