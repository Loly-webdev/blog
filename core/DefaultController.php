<?php

require_once PROJECT_ROOT . 'core/DefaultControllerInterface.php';

abstract class DefaultController implements DefaultControllerInterface
{
    public function renderView($partial, $template = PROJECT_ROOT . 'view/frontend/template.php')
    {
        ob_start();
        include($partial);
        $content = ob_get_clean();

        include($template);
    }
}
