<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Email;
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
            $userId    = $_SESSION['user'];
            $user      = (new UserRepository())->findOneById($userId);
            $nameUser  = $user->getLogin();
            $emailUser = $user->getMail();
        }

        if ($this->hasFormSubmitted($entityName)) {
            $formData  = $this->getFormSubmittedValues($entityName);
            $nameUser  = $formData['nameUser'] ? Email::verifyText($formData['nameUser']) : '';
            $emailUser = $formData['email'] ?? '';

            // We prepare the fields
            $subject        = $formData['subject'] ? Email::verifyText($formData['subject']) : '';
            $messageContent = $formData['message'] ? Email::verifyText($formData['message']) : '';

            $errorMessage = "une erreur est survenue, le mail n'a pas pu être envoyé";

            if (Email::sendMail($emailUser, $nameUser, $subject, $messageContent)) {
                $errorMessage = "Le mail à été envoyé avec succès";
            }
        }

        $this->renderView(
            'contact.html.twig',
            [
                'nameUser'     => $nameUser ?? '',
                'email'        => $emailUser ?? '',
                'errorMail'    => $errorMail ?? '',
                'errorMessage' => $errorMessage ?? ''
            ]
        );
    }
}
