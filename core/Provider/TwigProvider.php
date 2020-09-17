<?php

namespace Core\Provider;

use Twig\{Environment, Extension\DebugExtension, Loader\FilesystemLoader};

/**
 * Class TwigProvider
 * @package Core
 */
class TwigProvider
{
    protected static $twig;
    protected static $debug;

    /**
     * Instance of Twig
     * @return mixed
     */
    public static function getTwig()
    {
        $config = ConfigurationProvider::getInstance();
        $debug  = $config::getTwigConfig();

        if (null === static::$twig) {
            $loader       = new FilesystemLoader('template/');
            static::$twig = new Environment(
                $loader,
                // To the prod define the path of directory Cache, else to dev keep false
                [
                    'cache' => false,
                    'debug' => $debug
                ]
            );

            // To debug
            if (is_null($debug)) {
                static::$twig->addExtension(new DebugExtension());
            }
        }
        return static::$twig;
    }
}
