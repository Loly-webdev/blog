<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Email;
use App\utils\Helper;
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
        $viewFolder = 'front/';

        if (isset($_SESSION['logged']) === true) {
            $viewFolder = 'back/';

            $userId = $_SESSION['id'];
            $user   = (new UserRepository())->findOneById($userId);
            assert($user instanceof User);
            $nameUser  = $user->getLogin();
            $emailUser = $user->getMail();
        }

        $formValidator = new FormContactValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            $formValues = $formValidator->getFormValues();
            $nameUser   = $formValues['nameUser'] ? Helper::verifyText($formValues['nameUser']) : '';
            $emailUser  = $formValues['email'] ?? '';

            if (false === Helper::verifyAddress($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            // We prepare the fields
            $subject        = $formValues['subject'] ? Helper::verifyText($formValues['subject']) : '';
            $messageContent = $formValues['message'] ? Helper::verifyText($formValues['message']) : '';
            $message        = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
                              . $messageContent;

            $status        = "danger";
            $statusMessage = "une erreur est survenue, le mail n'a pas pu être envoyé";

            if (true === (new Email())->sendMail($emailUser, $subject, $message)) {
                $status        = "success";
                $statusMessage = "Le mail à été envoyé avec succès";
            }
        }

        $this->renderView(
            'contact.html.twig',
            [
                'nameUser'      => $nameUser ?? '',
                'email'         => $emailUser ?? '',
                'status'        => $status ?? '',
                'statusMessage' => $statusMessage ?? ''
            ],
            $viewFolder
        );
    }
}
