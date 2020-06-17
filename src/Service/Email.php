<?php

namespace App\Service;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Provider\ConfigurationProvider;
use Exception;

class Email extends DefaultAbstractController
{
    public function indexAction()
    {
        header('Location: /Home');
        exit();
    }

    public function sendMail(string $entityName, string $view): void
    {
        $myMail = ConfigurationProvider::getInstance()->getMyMail();

        if (isset($_SESSION['logged']) === true) {
            $userId    = $_SESSION['user'];
            $user      = (new UserRepository())->findOneById($userId);
            $nameUser  = $user->getLogin();
            $emailUser = $user->getMail();
        }

        if ($this->hasFormSubmitted($entityName)) {
            $formData  = $this->getFormSubmittedValues($entityName);
            $nameUser  = $formData['nameUser'] ? static::verifyText($formData['nameUser']) : '';
            $emailUser = $formData['email'] ?? '';

            if (false === static::verifyAddress($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            // We prepare the fields
            $header         = static::getDefaultHeader($emailUser);
            $subject        = $formData['subject'] ? static::verifyText($formData['subject']) : '';
            $messageContent = $formData['message'] ? static::verifyText($formData['message']) : '';
            $message        = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
                              . $messageContent;

            $status        = "danger";
            $statusMessage = "une erreur est survenue, le mail n'a pas pu être envoyé";

            if (mail($myMail, $subject, $message, $header)) {
                $status        = "success";
                $statusMessage = "Le mail à été envoyé avec succès";
            }
        }
        $this->renderView(
            $view,
            [
                'nameUser'      => $nameUser ?? '',
                'email'         => $emailUser ?? '',
                'status'        => $status ?? '',
                'statusMessage' => $statusMessage ?? ''
            ]
        );
    }

    public static function verifyText($text): string
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

    public static function getDefaultHeader($emailUser)
    {
        // We fill in the headers of the PHP mail function
        return "MIME-Version: 1.0\r\n"
               . "Content-type: text/html; charset=UTF-8\r\n"
               . "From: $emailUser\r\n"
               . "Reply-To: $emailUser\r\n";
    }
}
