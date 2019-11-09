<?php

require(PROJECT_ROOT . 'core/DefaultControllerInterface.php');

abstract class DefaultController implements DefaultControllerInterface
{
    public function renderView($partial, $template = '/view/frontend/template')
    {
        ob_start();
        include($partial); // -> /view/front/mavue...
        $content = ob_get_clean();

        include(PROJECT_ROOT . $template);
    }
}

//faire une methode renderview