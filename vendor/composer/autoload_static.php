<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit00060ceae16242fe45db8e33324914e6
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit00060ceae16242fe45db8e33324914e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit00060ceae16242fe45db8e33324914e6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit00060ceae16242fe45db8e33324914e6::$classMap;

        }, null, ClassLoader::class);
    }
}
