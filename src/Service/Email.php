<?php

namespace App\Service;

use Core\DefaultAbstract\DefaultAbstractController;
use Core\Provider\ConfigurationProvider;

class Email extends DefaultAbstractController
{
    public function indexAction()
    {
        header('Location: /Home');
        exit();
    }

    public function sendMail(string $emailUser, string $subject, string $message): bool
    {
        $myMail = ConfigurationProvider::getInstance()->getMyMail();

        $header = static::getDefaultHeader($emailUser);

        if (mail($myMail, $subject, $message, $header)) {

            return true;
        }

        return false;
    }

    public static function getDefaultHeader($emailUser)
    {
        // We fill in the headers of the PHP mail function
        return "MIME-Version: 1.0\r\n"
               . "Content-type: text/html; charset=UTF-8\r\n"
               . "From: $emailUser\r\n"
               . "Reply-To: $emailUser\r\n";
    }
}
