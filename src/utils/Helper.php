<?php

namespace App\utils;

class Helper
{
    public static function securizeText($text): string
    {
        $text = htmlspecialchars(trim($text), ENT_QUOTES);
        $text = nl2br($text);

        return $text;
    }

    public static function verifyAddress($email): bool
    {
        //  We check that the address is correct
        $regex = "#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i";

        return preg_match($regex, $email);
    }
}
