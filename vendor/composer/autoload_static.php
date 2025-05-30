<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita232af57035e0ad444835781f76d7d9e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MemoryOlympiad\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MemoryOlympiad\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInita232af57035e0ad444835781f76d7d9e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita232af57035e0ad444835781f76d7d9e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita232af57035e0ad444835781f76d7d9e::$classMap;

        }, null, ClassLoader::class);
    }
}
