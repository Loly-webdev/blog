<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;

/**
 * Class RegisterController
 * @package App\Controller
 */
class RegisterController extends DefaultAbstractController
{
    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        if($this->hasFormSubmitted('authentication')) {
            echo 'Votre formulaire à déjà été soumis';
        }

        $this->renderView(
            'formRegister.html.twig'
        );
    }

    public function registerAction()
    {
        if ($this->hasFormSubmitted('formRegister')) {
            $dataSubmitted = $this->getFormSubmittedValues('formRegister');
            $entity        = (new User)->hydrate($dataSubmitted);

            $message = (new UserRepository())->insert($entity)
                ? "Votre requête à bien était enregistré !"
                : "Désolé, une erreur est survenue. Si l'erreur persiste veuillez prendre contact avec l'administrateur.";
        }

        $this->renderView(
            'formAuthentication.html.twig',
            [
                'message' => $message ?? ''
            ]
        );
    }
}
