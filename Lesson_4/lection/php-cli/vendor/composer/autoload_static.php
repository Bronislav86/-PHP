<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1401a21fd4a4e44468118b0cc1a19dbf
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Oop\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Oop\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1401a21fd4a4e44468118b0cc1a19dbf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1401a21fd4a4e44468118b0cc1a19dbf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1401a21fd4a4e44468118b0cc1a19dbf::$classMap;

        }, null, ClassLoader::class);
    }
}