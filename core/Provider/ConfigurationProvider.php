<?php

namespace Core\Provider;

use Core\Exception\CoreException;

/**
 * Class Configuration
 * @package Config
 */
class ConfigurationProvider
{
    // Will contain the instance of our class.
    private static $instance;
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
     */
    public static function getInstance(): ConfigurationProvider
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public static function getTwigConfig(): array
    {
        return static::$config['twig'] ?? [];
    }

    /**
     * @return string
     */
    public static function getEnvironment(): string
    {
        return static::$config['env']
            ? strtolower(static::$config['env'])
            : 'prod';
    }

    /**
     * @return bool
     */
    public static function isValid(): bool
    {
        return !empty(static::getDatabaseConfig());
    }

    /**
     * @return array
     */
    public static function getDatabaseConfig(): array
    {
        return static::$config['databases'] ?? [];
    }

    /**
     * @return string
     */
    public function getMyMail(): string
    {
        return static::$config['myMail'] ?? '';
    }

    /**
     * Denies access to the __clone() method
     */
    private function __clone()
    {
    }
}
