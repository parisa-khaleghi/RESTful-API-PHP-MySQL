<?php
    $db_user     = 'root';
    $db_password = 'root';
    $db_name     = 'restful_api_db';

    $db = new PDO('mysql:host=127.0.0.1; dbname='.$db_name.';charset=utf8', $db_user, $db_password);

?>