<?php

namespace App\Controller;

use App\Entity\User;
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
        if (isset($_SESSION['logged'])) {
            $viewFolder = 'back/';
            $user = $this->getUserLogged();
        }

        $formValidator = new FormContactValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {
            $formValues = $formValidator->getFormValues();
            $nameUser = Helper::secureText($formValues['nameUser']);
            $emailUser = $formValues['email'] ?? '';

            if (false === Helper::checkEmail($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            $fields = $this->prepareFields($formValues, $nameUser, $emailUser);

            $status = static::statusMessage($emailUser, $fields['subject'], $fields['message']);
        }

        $this->renderView(
            'contact.html.twig',
            [
                'user' => $user ?? new User(),
                'status' => $status ?? '',
            ],
            $viewFolder ?? 'front/'
        );
    }

    /**
     * @param array|mixed[] $formValues
     * @param mixed $nameUser
     * @param mixed $emailUser
     * @return array|mixed[]
     */
    public function prepareFields(array $formValues, $nameUser, $emailUser): array
    {
        $subject = $formValues['subject'] ? Helper::secureText($formValues['subject']) : '';
        $messageContent = $formValues['message'] ? Helper::secureText($formValues['message']) : '';
        $message = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser<br>"
            . $messageContent;

        return [
            'subject' => $subject,
            'message' => $message
        ];
    }

    /**
     * @param mixed $emailUser
     * @param mixed $subject
     * @param mixed $message
     * @return array|mixed[]
     */
    static public function statusMessage($emailUser, $subject, $message): array
    {
        return Message::getMessage(
            Email::sendMail($emailUser, $subject, $message),
            'Le mail à été envoyé avec succès',
            'une erreur est survenue, le mail n\'a pas pu être envoyé'
        );
    }
}
