<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitee6cd97669c4b3911255330127e622b0
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\AbstractController' => __DIR__ . '/../..' . '/src/Controllers/AbstractController.php',
        'App\\Controllers\\AdminController' => __DIR__ . '/../..' . '/src/Controllers/AdminController.php',
        'App\\Controllers\\HomeController' => __DIR__ . '/../..' . '/src/Controllers/HomeController.php',
        'App\\Controllers\\PostController' => __DIR__ . '/../..' . '/src/Controllers/PostController.php',
        'App\\Controllers\\UserController' => __DIR__ . '/../..' . '/src/Controllers/UserController.php',
        'App\\Library\\Config' => __DIR__ . '/../..' . '/src/Library/Config.php',
        'App\\Library\\Database' => __DIR__ . '/../..' . '/src/Library/Database.php',
        'App\\Library\\Loader' => __DIR__ . '/../..' . '/src/Library/Loader.php',
        'App\\Models\\AdminModel' => __DIR__ . '/../..' . '/src/Models/AdminModel.php',
        'App\\Models\\PostModel' => __DIR__ . '/../..' . '/src/Models/PostModel.php',
        'App\\Models\\UserModel' => __DIR__ . '/../..' . '/src/Models/UserModel.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitee6cd97669c4b3911255330127e622b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitee6cd97669c4b3911255330127e622b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitee6cd97669c4b3911255330127e622b0::$classMap;

        }, null, ClassLoader::class);
    }
}
