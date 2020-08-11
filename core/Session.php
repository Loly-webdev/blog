<?php

namespace Core;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractEntity;

/**
 * Class Session
 * @package Core
 */
final class Session
{
    // Will contain the instance of our class.
    private static $instance;
    private static $hasLogged  = false;
    private        $userLogged;
    private        $data;

    /**
     * Request constructor.
     * Prevents the creation of an instance
     */
    private function __construct()
    {
        $this->data        = $_SESSION;
        $this->userLogged  = (new userRepository())->findOneById($_SESSION['id']);
        static::$hasLogged = null !== $this->userLogged;
    }

    /**
     * recovers a value from the session
     * and returns the value or returns the default value.
     *
     * @param string $key
     * @param null   $defaultValue
     *
     * @return mixed|null
     */
    public static function getValue(string $key, $defaultValue = null)
    {
        $data = (static::getInstance())->getData();

        return $data[$key] ?? $defaultValue;

        /*return isset($data[$key])
            ? $data[$key]
            : $defaultValue;*/
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Singleton of session object to load once this method
     * @return Session
     */
    public static function getInstance(): Session
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return DefaultAbstractEntity|null
     */
    public static function getUserLogged(): ?DefaultAbstractEntity
    {
        return (static::getInstance())->retrieveUserLogged();
    }

    /**
     * @return DefaultAbstractEntity|null
     */
    public function retrieveUserLogged(): ?DefaultAbstractEntity
    {
        return $this->userLogged;
    }

    /**
     * @param string $key
     * @param        $value
     *
     * @return void
     */
    public static function setValue(string $key, $value): void
    {
        $_SESSION[$key] = $value;

        /*$data       = (static::getInstance())->getData();
        $data[$key] = $value;
        (static::getInstance())->setData($data);*/
    }

    /**
     * @return bool
     */
    public static function hasLogged(): bool
    {
        return static::$hasLogged;
    }
}

