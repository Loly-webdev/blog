<?php

namespace App\utils;

use Core\Provider\ConfigurationProvider;

/**
 * Class Helper
 * @package App\utils
 */
class Helper
{
    /**
     * @param mixed $text
     * @return mixed
     */
    public static function secureText($text)
    {
        return nl2br(htmlspecialchars(trim($text), ENT_QUOTES));
    }

    /**
     * @param mixed $email
     * @return bool
     */
    public static function checkEmail($email): bool
    {
        // Remove all illegal characters from email
        $emailFilter = filter_var($email, FILTER_SANITIZE_EMAIL);

        return filter_var($emailFilter, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param mixed $password
     * @return string
     */
    static function encodePassword($password): string
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_hash($password . $salt, PASSWORD_ARGON2ID);
    }

    /**
     * @param string $passwordSubmitted
     * @param string $passwordUser
     * @return bool
     */
    public static function checkPassword(string $passwordSubmitted, string $passwordUser): bool
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_verify($passwordSubmitted . $salt, $passwordUser);
    }
}
