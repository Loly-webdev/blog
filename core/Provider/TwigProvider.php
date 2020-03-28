<?php

namespace Core\Provider;

use Config\Configuration;
use Exception;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

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
     * @throws Exception
     */
    public static function getTwig()
    {
        $config = Configuration::getInstance();
        $debug = $config->getTwigConfig();

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
        }

        // To debug
        if (is_null($debug)) {
            static::$twig->addExtension(new DebugExtension());
        }

        return static::$twig;
    }
}
