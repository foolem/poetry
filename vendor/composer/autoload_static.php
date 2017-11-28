<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit019e7b12abee5e7246ea0ca1b454e94a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit019e7b12abee5e7246ea0ca1b454e94a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit019e7b12abee5e7246ea0ca1b454e94a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}