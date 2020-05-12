<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Provider\ConfigurationProvider;

class User extends DefaultAbstractEntity
{
    protected $mail;
    protected $login;
    protected $password;
    protected $role;

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     *
     * @return User
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $plainText
     *
     * @return void
     */
    public function setPassword(string $plainText)
    {
        $this->password = static::encodePassword($plainText);
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    static function encodePassword(string $plainText)
    {
        $config = ConfigurationProvider::getInstance();
        $salt = $config->getSalt();
        $pwd_peppered = hash_hmac("sha256", $plainText, $salt);

        return password_hash($pwd_peppered, PASSWORD_ARGON2ID);
    }

    public function __serialize()
    {
        return $this->getSessionValues();
    }

    public function getSessionValues()
    {
        return [
            'mail' => $this->getMail(),
            'username' => $this->getLogin(),
            'password' => $this->getPassword(),
            'role' => $this->getRole()
        ];
    }
}
