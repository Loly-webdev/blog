<?php

require_once PROJECT_CORE . 'DefaultControllerInterface.php';

abstract class DefaultController implements DefaultControllerInterface
{
    public function renderView($partial, array $params = [])
    {
        extract($params);

        $template = PROJECT_VIEW. 'Front/template.php';
        ob_start();
        include($partial);
        $content = ob_get_clean();

        include($template);


    }
}
