<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Provider\ConfigurationProvider;

class User extends DefaultAbstractEntity
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER  = 'user';

    const ROLE_ADMIN_LABEL = 'Administrateur';
    const ROLE_USER_LABEL  = 'Utilisateur';

    const ROLES = [
        self::ROLE_ADMIN => self::ROLE_ADMIN_LABEL,
        self::ROLE_USER  => self::ROLE_USER_LABEL
    ];

    protected $mail;
    protected $login;
    protected $password;
    protected $role;

    public function __serialize()
    {
        return $this->getSessionValues();
    }

    public function getSessionValues()
    {
        return [
            'mail'     => $this->getMail(),
            'username' => $this->getLogin(),
            'password' => $this->getPassword(),
            'role'     => $this->getRole()
        ];
    }

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
    public function getPassword(): string
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

    static function encodePassword(string $password)
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_hash($password . $salt, PASSWORD_ARGON2ID);
    }

    /**
     * @param mixed $role
     *
     * @return User
     */
    public function setRole($role)
    {
        if (in_array($role, self::ROLES)) {
            $this->role = $role;
        }
        return $this->role = $role;
    }

    public function isAdmin()
    {
        return self::ROLE_ADMIN === $this->getRole();
    }

    public function getRoleLabel($code)
    {
        return isset(self::ROLES[$code])
            ? self::ROLES[$code]
            : 'Aucun role définit';
    }
}
