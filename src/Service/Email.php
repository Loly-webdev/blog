<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\utils\Helper;
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

    public function sendMail(string $entityName, string $view): bool
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
            $nameUser  = $formData['nameUser'] ? Helper::verifyText($formData['nameUser']) : '';
            $emailUser = $formData['email'] ?? '';

            if (false === Helper::verifyAddress($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            // We prepare the fields
            $header         = static::getDefaultHeader($emailUser);
            $subject        = $formData['subject'] ? Helper::verifyText($formData['subject']) : '';
            $messageContent = $formData['message'] ? Helper::verifyText($formData['message']) : '';
            $message        = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
                              . $messageContent;

            $status        = "danger";
            $statusMessage = "une erreur est survenue, le mail n'a pas pu être envoyé";

            if (mail($myMail, $subject, $message, $header)) {
                $status        = "success";
                $statusMessage = "Le mail à été envoyé avec succès";

                return true;
            }
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
