<?php

namespace App\Entity;

use App\utils\Helper;
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
        $this->password = Helper::encodePassword($plainText);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return static::ROLE_ADMIN === $this->getRole();
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
        $this->role = in_array($role, static::ROLES);
    }

    /**
     * @param string $code
     * @return string
     */
    public function getRoleLabel($code): string
    {
        return self::ROLES[$code] ?? 'Aucun role définit';
    }
}
