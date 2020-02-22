<?php

require_once PROJECT_CORE . 'DefaultAbstractController.php';
require_once PROJECT_REPOSITORY . 'UserRepository.php';

class UserController extends DefaultAbstractController
{
    private $user_name;
    private $user_pass;

    public function getName()
    {
        return $this->user_name;
    }

    public function setName($new_user_name)
    {
        $this->user_name = $new_user_name;
    }

    public function setPass($new_user_pass)
    {
        $this->user_pass = $new_user_pass;
    }

    public function indexAction()
    {
        $this->renderView(
            'connexion.html.twig'
        );
    }

    public function connexionAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('user');

        (new UserRepository())->connect();

        $message = '';      // Message à afficher à l'utilisateur

        // Si le tableau $_POST existe alors le formulaire a été envoyé
        if(!empty($data))
        {
            // Le login est-il rempli ?
            if(empty($data['login']))
            {
                $message = 'Veuillez indiquer votre login svp !';
            }
            // Le mot de passe est-il rempli ?
            elseif(empty($data['pass']))
            {
                $message = 'Veuillez indiquer votre mot de passe svp !';
            }
            // Le login est-il correct ?
            /*elseif($data['login'] !== $data['login'])
            {
                $message = 'Votre login est faux !';
            }
            // Le mot de passe est-il correct ?
            elseif($data['motDePasse'] !== $data['pass'])
            {
                $message = 'Votre mot de passe est faux !';
            }*/
            else
            {
                // L'identification a réussi
                $message = 'Bienvenue '. $data['login'] .' !';
            }
        }

        $this->renderView(
            'user.html.twig',
            [
                'message' => $message
            ]
        );

    }

    public function inscriptionAction()
    {
        // Retrieve all data in a table
        $data = $this->getRequest()->getParam('user');

        (new UserRepository())->add($data);

        $message = '';      // Message à afficher à l'utilisateur

        // Si le tableau $_POST existe alors le formulaire a été envoyé
        if(!empty($data))
        {
            // Le login est-il rempli ?
            if(empty($data['login']))
            {
                $message = 'Veuillez indiquer votre login svp !';
            }
            // Le mot de passe est-il rempli ?
            elseif(empty($data['pass']))
            {
                $message = 'Veuillez indiquer votre mot de passe svp !';
            }
            else
            {
                // L'identification a réussi
                $message = 'Bienvenue '. $data['login'] .' !';
            }
        }

        $this->renderView(
            'user.html.twig',
            [
                'message' => $message
            ]
        );
    }
}
