<?php

namespace Core\Provider;

use Core\Exception\CoreException;

/**
 * Class Configuration
 * @package Config
 */
class ConfigurationProvider
{
    private static $instance; // Will contain the instance of our class.
    private static $config = [];

    /**
     * Configuration constructor.
     * Prevents the creation of an instance
     * @throws CoreException
     */
    private function __construct()
    {
        $path = CONF_ROOT . "env.yml";
        if (false === file_exists($path)) {
            throw new CoreException("Le fichier $path n'existe pas.");
        }

        static::$config = yaml_parse_file($path);
    }

    /**
     * Singleton of request object to load once this method
     * @return ConfigurationProvider
     * @throws CoreException
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

    public function getSalt(): string
    {
        return 'salt';
    }

    /**
     * Denies access to the __clone() method
     */
    private function __clone()
    {
    }

    public static function getEnvironment(): string
    {
        return static::$config['env']
            ? strtolower(static::$config['env'])
            : 'prod';
    }

    public static function isValid()
    {
        return !empty(static::getDatabaseConfig());
    }
}
