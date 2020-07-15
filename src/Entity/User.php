<?php

namespace App\Entity;

use App\utils\Helper;
use Core\DefaultAbstract\DefaultAbstractEntity;
use Core\Exception\CoreException;

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

    protected $mail = '';
    protected $login = '';
    protected $password = '';
    protected $role = '';

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     *
     * @return User
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $passwordSubmitted
     * @return User
     */
    public function setPassword(string $passwordSubmitted)
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
     * @return string
     */
    public function getRole():string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return User
     * @throws CoreException
     */
    public function setRole(string $role)
    {
        $existingRole = [self::ROLE_ADMIN, self::ROLE_USER];
        if (!in_array($role, $existingRole)) {
            throw new CoreException('Le rôle ' . $role . ' saisie n\'existe pas ou n\'est pas valide');
        }
        $this->role = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoleLabel(): string
    {
        $role = $this->role();

        return static::ROLES[$role] ?? 'Aucun role définit';
    }


    /**
     * @return string
     */
    public function role(): string
    {
        if ($this->isAdmin()) {
            return User::ROLE_ADMIN;
        }
        return User::ROLE_USER;
    }
}
