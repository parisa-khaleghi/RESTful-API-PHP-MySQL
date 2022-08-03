<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'MAMP'.DS.'htdocs'.DS.'RESTful-API-PHP-MySQL');
    //MAMP/htdocs/RESTful-API-PHP-MySQL/includes
    //INC_PATH => include dir path
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    //MAMP/htdocs/RESTful-API-PHP-MySQL/core
    //CORE_PATH => core dir path
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

    //load the config file first
    require_once(INC_PATH.DS.'config.php');

    //core classes
    require_once(CORE_PATH.DS.'post.php');
?>