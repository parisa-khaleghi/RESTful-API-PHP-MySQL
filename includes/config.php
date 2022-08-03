<?php
    $db_user     = 'root';
    $db_password = 'root';
    $db_name     = 'restful_api_db';

    $db = new PDO('mysql:host=localhost; dbname='.$db_name.';charset=utf8', $db_user, $db_password);

    //set some db attributes
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //this make db connection faster
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    define('APP_NAME', 'PHP REST API TUTORIAL')
?>