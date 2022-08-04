<?php
    declare(strict_types=1);

    spl_autoload_register(function($class){
        require __DIR__ . "/src/$class.php";
    });

    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    if($parts[2] != "post"){
        http_response_code(404);
        exit;
    }

    $id = $parts[3] ?? null;

    $controller = new Post();
    $controller->process_request($_SERVER["REQUEST_METHOD"], $id);
?>