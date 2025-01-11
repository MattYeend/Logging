<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit89ed1c4da7bda6b88c69a2848aab6521
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MattYeend\\Logging\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MattYeend\\Logging\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit89ed1c4da7bda6b88c69a2848aab6521::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit89ed1c4da7bda6b88c69a2848aab6521::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit89ed1c4da7bda6b88c69a2848aab6521::$classMap;

        }, null, ClassLoader::class);
    }
}
