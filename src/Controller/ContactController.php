<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Email;
use App\Service\Message;
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
        if ($_SESSION['logged']) {
            $viewFolder = 'back/';
            $user = $this->getUserLogged();
        }

        $formValidator = new FormContactValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            $formValues = $formValidator->getFormValues();
            $nameUser = Helper::secureText($formValues['nameUser']);
            $emailUser = $formValues['email'] ?? '';

            if (false === Helper::verifyAddress($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            $fields = $this->prepareFields($formValues, $nameUser, $emailUser);

            $status = static::statusMessage($emailUser, $fields['subject'], $fields['message']);
        }

        $this->renderView(
            'contact.html.twig',
            [
                'user' => $user ?? new User,
                'status' => $status ?? '',
            ],
            $viewFolder ?? 'front/'
        );
    }

    public function prepareFields($formValues, $nameUser, $emailUser): array
    {
        $subject = $formValues['subject'] ? Helper::secureText($formValues['subject']) : '';
        $messageContent = $formValues['message'] ? Helper::secureText($formValues['message']) : '';
        $message = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
            . $messageContent;

        return [
            'subject' => $subject,
            'message' => $message
        ];
    }

    static public function statusMessage($emailUser, $subject, $message): array
    {
        return Message::getMessage(
            Email::sendMail($emailUser, $subject, $message),
            'Le mail à été envoyé avec succès',
            'une erreur est survenue, le mail n\'a pas pu être envoyé'
        );
    }
}
