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
    private $userLogged = null;
    private $data = [];

    /**
     * Request constructor.
     * Prevents the creation of an instance
     */
    private function __construct()
    {
        $this->data = $_SESSION;
        $this->userLogged = (new userRepository())->findOneById($_SESSION['id']);
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
     * Singleton of request object to load once this method
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
     * reccupere une valeur de la session
     * et retourne la valeur ou retourne la valeur par defaut
     *
     * @param string $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public static function getValue(string $key, $defaultValue = null)
    {
        $data = (self::getInstance())->getData();

        return isset($data[$key])
            ? $data[$key]
            : $defaultValue;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}

