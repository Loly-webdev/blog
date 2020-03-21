<?php

namespace Core;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

class TwigProvider
{
    protected static $twig;
    protected static $debug;

    public static function getTwig()
    {
        $debug = true;
        // instance of Twig
        if (null === static::$twig) {
            $loader       = new FilesystemLoader('template/');
            static::$twig = new Environment($loader,
                // To the prod define the path of directory Cache, else to dev keep false
                                            [
                                                'cache' => false,
                                                'debug' => $debug //ou true
                                            ]
            );
        }

        if (is_null($debug)) {
            static::$twig->addExtension(new DebugExtension());
        }

        return static::$twig;
    }
}
