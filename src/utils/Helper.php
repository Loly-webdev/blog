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
     * @param string $text
     * @return string
     */
    public static function secureText(string $text = ''): string
    {
        return nl2br(htmlspecialchars(trim($text), ENT_QUOTES));
    }

    /**
     * @param string $email
     * @return mixed
     */
    public static function checkEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $password
     * @return false|string|null
     */
    static function encodePassword(string $password)
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_hash($password . $salt, PASSWORD_ARGON2ID);
    }

    /**
     * @param string $passwordSubmitted
     * @param string $passwordUser
     * @return bool
     */
    public static function checkPassword(
        string $passwordSubmitted,
        string $passwordUser
    ): bool
    {
        $salt = ConfigurationProvider::getInstance()->getSalt();

        return password_verify($passwordSubmitted . $salt, $passwordUser);
    }
}
