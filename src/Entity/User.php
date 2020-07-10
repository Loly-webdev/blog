<?php

namespace App\Entity;

use App\utils\Helper;
use Core\DefaultAbstract\DefaultAbstractEntity;

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
     * @param mixed $passwordSubmitted
     * @return User
     */
    public function setPassword($passwordSubmitted)
    {
        $this->password = Helper::encodePassword($passwordSubmitted);

        return $this;
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
     * @return string
     */
    public function setRole(string $role): string
    {
        if (in_array($role, static::ROLES)) {
            $this->role = $role;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getRoleLabel(): string
    {
        $code =$this->getRole();

        return self::ROLES[$code] ?? 'Aucun role définit';
    }
}
