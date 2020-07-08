<?php

namespace App\Entity;

use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Provider\ConfigurationProvider;

/**
 * Class User
 * @package App\Entity
 */
class User extends DefaultAbstractEntity
{
    /**
     *
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_ADMIN_LABEL = 'Administrateur';
    const ROLE_USER_LABEL = 'Utilisateur';
    const ROLES = [
        self::ROLE_ADMIN => self::ROLE_ADMIN_LABEL,
        self::ROLE_USER => self::ROLE_USER_LABEL
    ];

    /**
     * @var mixed
     */
    protected $mail;
    /**
     * @var mixed
     */
    protected $login;
    /**
     * @var mixed
     */
    protected $password;
    /**
     * @var string
     */
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
     * @param mixed $plainText
     *
     * @return void
     */
    public function setPassword($plainText)
    {
        $this->password = static::encodePassword($plainText);
    }

    /**
     * @param mixed $password
     * @return false|mixed|null
     */
    static function encodePassword($password)
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_hash($password . $salt, PASSWORD_ARGON2ID);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return self::ROLE_ADMIN === $this->getRole();
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     *
     * @return string
     */
    public function setRole(string $role): string
    {
        if (in_array($role, self::ROLES)) {
            $this->role = $role;
        }
        return $this->role = $role;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getRoleLabel($code): string
    {
        return isset(self::ROLES[$code])
            ? self::ROLES[$code]
            : 'Aucun role définit';
    }
}
