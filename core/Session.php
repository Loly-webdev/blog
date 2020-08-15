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

    /**
     * Request constructor.
     * Prevents the creation of an instance
     */
    private function __construct()
    {
        $userId = static::getValue('id');

        $this->userLogged  = empty($userId)
            ? null
            : (new userRepository())->findOneById($userId);

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
        $data = static::getData();

        return $data[$key] ?? $defaultValue;
    }

    /**
     * @return array
     */
    public static function getData(): array
    {
        return $_SESSION;
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
    }

    /**
     * @return bool
     */
    public static function hasLogged(): bool
    {
        return Session::getValue('id', null);
    }
}

