<?php

namespace Core;

/**
 * Class Request
 * @package Core
 * Get informations of URL
 * For exemple :
 * <code>
 * $requestURL = "monsite.fr/home/test?param1=value1&param2=value2"
 * $request = new Request();
 * $request = {
 *     $server = [
 *          'path' => '/home/test',
 *          'query' => 'param1=value1&param2=value2', // $_GET
 *     ];
 * }
 * </code>
 */
final class Request
{
    private static $instance; // Will contain the instance of our class.

    /**
     * Request constructor.
     * Prevents the creation of an instance
     */
    private function __construct()
    {
    }

    /**
     * Singleton of request object to load once this method
     * @return Request
     */
    public static function getInstance(): Request
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Get information of URL
     * @return array
     */
    public function getUrlComponents(): array
    {
        $server = parse_url($_SERVER["REQUEST_URI"]);
        $path   = trim($server['path'], "/");

        return "" !== $path
            ? explode('/', $path)
            : [];
    }

    /**
     * Get params $_POST et $_GET
     *
     * @param      $key
     * @param null $defaultValue
     *
     * @return mixed|null
     */
    public function getParam($key, $defaultValue = null): ?string
    {
        return $this->getQueryParam($key) ??
               $this->getRequestParam($key) ??
               $defaultValue;
    }

    /**
     * $_GET = params recover by $_GET method
     *
     * @param      $key
     * @param null $defaultValue
     *
     * @return mixed|null
     */
    public function getQueryParam($key, $defaultValue = null): ?string
    {
        return isset($_GET[$key]) && '' !== $_GET[$key]
            ? $_GET[$key]
            : $defaultValue;
    }

    /**
     * $_POST = params recover by $_POST method
     *
     * @param      $key
     * @param null $defaultValue
     *
     * @return mixed|null
     */
    public function getRequestParam($key, $defaultValue = null): ?string
    {
        return isset($_POST[$key]) && '' !== $_POST[$key]
            ? $_POST[$key]
            : $defaultValue;
    }

    /**
     * Denies access to the __clone() method
     */
    private function __clone()
    {
    }
}
