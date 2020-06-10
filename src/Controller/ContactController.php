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
        $this->mailAction();
    }

    public function mailAction()
    {
        $entityName = 'contact';

        if (isset($_SESSION['logged']) === true) {
            $userId = $_SESSION['user'];
            $user   = (new UserRepository())->findOneById($userId);
            $name   = $user->getLogin();
            $mail   = $user->getMail();
        }

        if ($this->hasFormSubmitted($entityName)) {
            $myMail   = "lolywebdev@gmail.com";
            $formData = $this->getFormSubmittedValues($entityName);
            $name     = $formData['name'];
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
            $header .= "From: MESSAGE DU SITE LOLYWEBDEV <$mail>\r\n";
            $header .= "Reply-To: $name <$mail>\r\n";

            //on prépare les champs:
            $subject        = htmlentities($formData['subject'], ENT_QUOTES, "UTF-8");
            $messageContent = htmlentities($formData['message'], ENT_QUOTES, "UTF-8");

            //en fin, on envoi le mail
            dump($myMail, $subject, nl2br($messageContent), $header);
            if (mail($myMail, $subject, nl2br($messageContent), $header)) {
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
}
