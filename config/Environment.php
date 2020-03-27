<?php

namespace Config;

class Environment
{
    private static $instance; // Will contain the instance of our class.

    /**
     * Environment constructor.
     * Prevents the creation of an instance
     */
    private function __construct()
    {
    }

    /**
     * Denies access to the __clone() method
     */
    private function __clone()
    {
    }

    /**
     * Singleton of request object to load once this method
     * @return Environment
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    static function getDatabaseConfig(): array
    {
        $path = "Config.yml";
        $toArray = yaml_parse_file($path);
        yaml_emit_file($path, $toArray);
    }
}
