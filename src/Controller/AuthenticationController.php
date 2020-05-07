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
        // on teste si nos variables sont définies
        if (isset($_POST['login']) && isset($_POST['password'])) {

            // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
            $dataSubmitted = $this->getFormSubmittedValues('User');
            $entity        = $entity = (new User)->hydrate($dataSubmitted);;
            $login_valid    = $entity['login'];
            $password_valid = $entity['password'];

            if ($login_valid == $_POST['login'] && $password_valid == $_POST['pwd']) {
                // dans ce cas, tout est ok, on peut démarrer notre session

                // on la démarre :)
                session_start();
                // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
                $_SESSION['login']    = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];

                // on redirige notre visiteur vers une page de notre section membre
                header('location: page_membre.php');
            }
            else {
                // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
                echo '<body onLoad="alert(\'Membre non reconnu...\')">';
                // puis on le redirige vers la page d'accueil
                echo '<meta http-equiv="refresh" content="0;URL=index.htm">';
            }
        }
        else {
            echo 'Les variables du formulaire ne sont pas déclarées.';
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
