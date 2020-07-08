<?php

namespace App\Service;

use Core\DefaultAbstract\DefaultAbstractController;
use Core\Provider\ConfigurationProvider;

/**
 * Class Email
 * @package App\Service
 */
abstract class Email extends DefaultAbstractController
{
    /**
     * @param mixed $emailUser
     * @param string $subject
     * @param string $message
     * @return bool
     */
    static public function sendMail($emailUser, string $subject, string $message): bool
    {
        $myMail = ConfigurationProvider::getInstance()->getMyMail();

        $header = static::getDefaultHeader($emailUser);

        if (mail($myMail, $subject, $message, $header)) {

            return true;
        }

        return false;
    }

    /**
     * @param mixed $emailUser
     * @return string
     */
    static public function getDefaultHeader($emailUser): string
    {
        // We fill in the headers of the PHP mail function
        return "MIME-Version: 1.0\r\n"
            . "Content-type: text/html; charset=UTF-8\r\n"
            . "From: $emailUser\r\n"
            . "Reply-To: $emailUser\r\n";
    }
}
