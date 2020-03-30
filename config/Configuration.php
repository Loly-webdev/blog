<?php

namespace Config;

use Exception;

/**
 * Class Configuration
 * @package Config
 */
class Configuration
{
    private static $instance; // Will contain the instance of our class.
    private static $config = [];

    /**
     * Configuration constructor.
     * Prevents the creation of an instance
     * @throws Exception
     */
    private function __construct()
    {
        $path = "config/env.yml";
        if (file_exists($path) === false) {
            throw new Exception("Le fichier $path n'existe pas.");
        }
        static::$config = yaml_parse_file($path);
    }

    /**
     * Singleton of request object to load once this method
     * @return Configuration
     * @throws Exception
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    static function getDatabaseConfig(): array
    {
        return static::$config['databases'] ?? [];
    }

    /**
     * @return array
     */
    static function getTwigConfig(): array
    {
        return static::$config['twig'] ?? [];
    }

    /**
     * Denies access to the __clone() method
     */
    private function __clone()
    {
    }
}