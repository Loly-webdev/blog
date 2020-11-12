<?php

namespace App\Controller;

use App\Controller\FormValidator\FormContactValidator;
use App\Entity\User;
use App\Service\Email;
use App\Service\Message;
use App\utils\Helper;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\DefaultAbstract\FormValidatorAbstract;
use Core\Exception\CoreException;
use Core\Session;
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
     * @throws CoreException
     * @throws Exception
     */
    public function indexAction()
    {
        if (isset($_SESSION['logged'])) {
            $viewFolder = 'back/';
            $user       = $this->getUserLogged();
        }

        $formValidator = new FormContactValidator();
        if ($formValidator->isSubmitted() && $formValidator->isValid()) {
            $formValues = $formValidator->getFormValues();
            $nameUser   = Helper::secureText($formValues['nameUser']);
            $emailUser  = $formValues['email'] ?? '';

            $this->mailValid($formValidator, $emailUser);
            $fields = $this->prepareFields($formValues, $nameUser, $emailUser);
            $status = static::statusMessage($emailUser, $fields['subject'], $fields['message']);
        }

        $token = Session::generateToken('contact');

        $this->renderView(
            'contact.html.twig',
            [
                'user'       => $user ?? new User(),
                'status'     => $status ?? [''],
                'tokenValue' => $token,
                'errors'     => $formValidator->getMessageErrors()
            ],
            $viewFolder ?? 'front/'
        );
    }

    /**
     * @param FormValidatorAbstract $formValidator
     * @param string                $emailUser
     */
    public function mailValid(
        FormValidatorAbstract $formValidator,
        string $emailUser
    ): void
    {
        if (false === Helper::checkEmail($emailUser)) {
            $formValidator->addError('emailUser', "l'adresse $emailUser n'est pas valide");
        }
    }

    /**
     * @param array|mixed[] $formValues
     * @param string        $nameUser
     * @param string        $emailUser
     *
     * @return array|mixed[]
     */
    public function prepareFields(
        array $formValues,
        string $nameUser,
        string $emailUser
    ): array
    {
        $subject        = $formValues['subject'] ? Helper::secureText($formValues['subject']) : '';
        $messageContent = $formValues['message'] ? Helper::secureText($formValues['message']) : '';
        $message        = "<br>de $nameUser, $emailUser
                           <br>$messageContent";

        return [
            'subject' => $subject,
            'message' => $message
        ];
    }

    /**
     * @param string $emailUser
     * @param string $subject
     * @param string $messageContent
     *
     * @return array|mixed[]
     */
    public static function statusMessage(
        string $emailUser,
        string $subject,
        string $messageContent
    ): array
    {
        return Message::getMessage(
            Email::sendMail($emailUser, $subject, $messageContent),
            'Le mail à été envoyé avec succès',
            'une erreur est survenue, le mail n\'a pas pu être envoyé'
        );
    }
}
