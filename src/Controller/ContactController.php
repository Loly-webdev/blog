<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Exception;

/**
 * Class ContactController
 * @package App\Controller
 */
class ContactController extends DefaultAbstractController
{
    /**
     * Action by default
     * Show form to contact
     * @return mixed|void
     * @throws Exception
     */
    public function indexAction()
    {
        $entityName = 'contact';

        if (isset($_SESSION['logged']) === true) {
            $userId   = $_SESSION['user'];
            $user     = (new UserRepository())->findOneById($userId);
            $name = $user->getLogin();
            $mail = $user->getMail();
        }

        if ($this->hasFormSubmitted($entityName)) {
            $myMail   = "lolywebdev@gmail.com";
            $formData = $this->getFormSubmittedValues($entityName);
            $name     = $formData['name'] ? $this->rec($formData['name']) : '';
            $mail     = $formData['email'];

            //on vérifie que l'adresse est correcte
            $regex = "#^[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?@[a-z0-9_-]+((\.[a-z0-9_-]+){1,})?\.[a-z]{2,}$#i";
            if (!preg_match($regex, $mail)) {
                $errorMail = "L'adresse $mail n'est pas valide";
            }

            //tout est correctement renseigné, on envoi le mail
            //on renseigne les entêtes de la fonction mail de PHP
            $header = "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html; charset=UTF-8\r\n";
            $header .= "From: $mail\r\n";
            $header .= "Reply-To: $mail\r\n";

            //on prépare les champs:
            $subject        = $formData['subject'] ? $this->rec($formData['subject']) : '';
            $messageContent = "<h2>MESSAGE DU SITE LOLYWEBDEV de $name, $mail</h2>"
                . $formData['message'] ? $this->rec($formData['message']) : '';

            //en fin, on envoi le mail
            dump(mail($myMail, $subject, $messageContent, $header),$myMail, $subject, $messageContent, $header);
            if (mail($myMail, $subject, $messageContent, $header)) {
                $message = "Le mail à été envoyé avec succès!";
            }
            $message = "Une erreur est survenue, le mail n'a pas été envoyé";
        }
        $this->renderView(
            'contact.html.twig',
            [
                'name'         => $name ?? '',
                'mail'         => $mail ?? '',
                'errorMail'    => $errorMail ?? '',
                'message'      => $message ?? ''
            ]
        );
    }

    function Rec($text)
    {
        $text = htmlspecialchars(trim($text), ENT_QUOTES);
        $text = nl2br($text);

        return $text;
    }
}
