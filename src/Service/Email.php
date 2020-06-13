<?php

namespace App\Service;

use Exception;

class Email
{
    public static function sendMail($emailUser, $nameUser, $subject, $messageContent)
    {
        $myMail = "lolywebdev@gmail.com";

        if (false === static::verifyAddress($emailUser)) {
            throw new Exception("l'adresse $emailUser n'est pas valide");
        }

        $header  = static::getDefaultHeader($emailUser);
        $message = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
                   . $messageContent;

        // Sending the mail
        return mail($myMail, $subject, $message, $header);
    }

    public static function verifyAddress($email): bool
    {
        //  We check that the address is correct
        $regex = "#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i";

        return preg_match($regex, $email);
    }

    public static function getDefaultHeader($emailUser)
    {
        // We fill in the headers of the PHP mail function
        return "MIME-Version: 1.0\r\n"
               . "Content-type: text/html; charset=UTF-8\r\n"
               . "From: $emailUser\r\n"
               . "Reply-To: $emailUser\r\n";
    }

    public static function verifyText($text): string
    {
        $text = htmlspecialchars(trim($text), ENT_QUOTES);
        $text = nl2br($text);

        return $text;
    }
}
