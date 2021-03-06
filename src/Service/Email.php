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
     * @param string $emailUser
     * @param string $subject
     * @param string $messageContent
     *
     * @return bool
     */
    public static function sendMail(
        string $emailUser,
        string $subject,
        string $messageContent
    ): bool
    {
        $myMail = ConfigurationProvider::getInstance()->getMyMail();

        $header = static::getDefaultHeader($emailUser);

        $message = 'MESSAGE DU SITE BlogLWD '
                   . $messageContent;

        return mail($myMail, $subject, $message, $header);
    }

    /**
     * @param string $emailUser
     *
     * @return string
     */
    public static function getDefaultHeader(string $emailUser): string
    {
        // We fill in the headers of the PHP mail function
        return "MIME-Version: 1.0\r\n"
               . "Content-type: text/html; charset=UTF-8\r\n"
               . "From: $emailUser\r\n"
               . "Reply-To: $emailUser\r\n";
    }

    /**
     * @param string $emailUser
     * @param string $subject
     * @param string $messageContent
     *
     * @return bool
     */
    public static function infoMail(
        string $emailUser,
        string $subject,
        string $messageContent
    ): bool
    {
        $myMail = ConfigurationProvider::getInstance()->getMyMail();

        $header = static::getDefaultHeader($myMail);

        $message = 'MESSAGE DU SITE BlogLWD '
                   . $messageContent;

        return mail($emailUser, $subject, $message, $header);
    }
}
