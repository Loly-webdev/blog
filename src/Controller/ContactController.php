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
        if (isset($_SESSION['logged']) === true) {
            $viewFolder = 'back/';
            $user = $this->contactLogged();
            $nameUser = $user->getLogin();
            $emailUser = $user->getMail();
        }

        $formValidator = new FormContactValidator();

        if ($formValidator->isSubmitted() && $formValidator->isValid()) {

            $formValues = $formValidator->getFormValues();
            $nameUser = $formValues['nameUser'] ? Helper::verifyText($formValues['nameUser']) : '';
            $emailUser = $formValues['email'] ?? '';


            if (false === Helper::verifyAddress($emailUser)) {
                throw new Exception("l'adresse $emailUser n'est pas valide");
            }

            $fields = $this->prepareFields($formValues, $nameUser, $emailUser);

            $status = $this->status($emailUser, $fields['subject'], $fields['message']);
        }

        $this->renderView(
            'contact.html.twig',
            [
                'nameUser' => $nameUser ?? '',
                'email' => $emailUser ?? '',
                'status' => $status['status'] ?? '',
                'statusMessage' => $status['statusMessage'] ?? ''
            ],
            $viewFolder ?? 'front/'
        );
    }

    public function contactLogged(): User
    {
        $userId = $_SESSION['id'];
        $user = (new UserRepository())->findOneById($userId);
        assert($user instanceof User);

        return $user;
    }

    public function status($emailUser, $subject, $message): array
    {
        $status = "danger";
        $statusMessage = "une erreur est survenue, le mail n'a pas pu être envoyé";

        if (true === (new Email())->sendMail($emailUser, $subject, $message)) {
            $status = "success";
            $statusMessage = "Le mail à été envoyé avec succès";
        }

        return [
            'status' => $status ?? '',
            'statusMessage' => $statusMessage ?? ''
        ];
    }

    public function prepareFields($formValues, $nameUser, $emailUser): array
    {
        $subject = $formValues['subject'] ? Helper::verifyText($formValues['subject']) : '';
        $messageContent = $formValues['message'] ? Helper::verifyText($formValues['message']) : '';
        $message = "MESSAGE DU SITE LOLYWEBDEV de $nameUser, $emailUser\r\n"
            . $messageContent;

        return [
            'subject' => $subject,
            'message' => $message
        ];
    }
}
