<?php

define('DS', DIRECTORY_SEPARATOR );
define('PRJ_ROOT', dirname(__FILE__) . DS . '..' . DS);
define('CONF_ROOT', dirname(__FILE__) . DS);
define('CORE_ROOT', PRJ_ROOT . 'core' . DS);
define('VIEW_ROOT', PRJ_ROOT . 'template' . DS);

use Core\Provider\ConfigurationProvider;

define('PRJ_ENV', ConfigurationProvider::getInstance()::getEnvironment());
