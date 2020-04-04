<?php

define('PRJ_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('CONF_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CORE_ROOT', PRJ_ROOT . 'core' . DIRECTORY_SEPARATOR);
define('VIEW_ROOT', PRJ_ROOT . 'template' . DIRECTORY_SEPARATOR);

use Core\Provider\ConfigurationProvider;
define('PRJ_ENV', ConfigurationProvider::getInstance()::getEnvironment());
