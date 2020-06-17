<?php

namespace App\Controller;

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
        $view       = 'contact.html.twig';
        (new Email())->sendMail($entityName, $view);
    }
}
