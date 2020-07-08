<?php

namespace App\utils;

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
        $text = htmlspecialchars(trim($text), ENT_QUOTES);
        $text = nl2br($text);

        return $text;
    }

    /**
     * @param mixed $email
     * @return bool
     */
    public static function verifyAddress($email): bool
    {
        //  We check that the address is correct
        $regex = "#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i";

        return preg_match($regex, $email);
    }
}
