<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Core\DefaultAbstract\DefaultAbstractController;
use Core\Exception\CoreException;

/**
 * Class AuthenticationController
 * @package App\Controller
 */
class AuthenticationController extends DefaultAbstractController
{
    /**
     * Action by default
     * @throws CoreException
     */
    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }

    /**
     * User login
     * @throws CoreException
     */
    public function loginAction(): void
    {
        if ($this->hasFormSubmitted('authentication')) {
            $dataSubmitted = $this->getFormSubmittedValues('User');
            $entity        = (new User)->hydrate($dataSubmitted);

            $message = (new UserRepository())->insert($entity)
                ? "Votre requête à bien était enregistré !"
                : "Désolé, une erreur est survenue. Si l'erreur persiste veuillez prendre contact avec l'administrateur.";

            $_SESSION['login'] = $entity['login'];
        }

        $this->renderView(
            'connexion.html.twig',
            [
                'message' => $message ?? ''
            ]
        );
    }

    /**
     * User logout
     */
    public function logoutAction()
    {
        session_unset();
        session_destroy();

       /* //Si lutilisateur est connecte, on le deconecte
        if(isset($_SESSION['login']))
        {
            //On le deconecte en supprimant la session
            unset($_SESSION['login']);
        }*/

        header('location: index.php');
        exit();
    }
}
