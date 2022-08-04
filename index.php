<?php
    declare(strict_types=1);

    spl_autoload_register(function($class){
        require __DIR__ . "/src/$class.php";
    });

    //it should be after autoloader
    set_exception_handler("ErrorHandler::handle_exception");

    //change content-type to json
    header("Content-type: application/json; charset=UTF-8");

    $parts = explode("/", $_SERVER["REQUEST_URI"]);

    if($parts[2] != "post"){
        http_response_code(404);
        exit;
    }

    $id = $parts[3] ?? null;

    // create an object of Database class
    $database = new Database("localhost", "restful_api_db", "root", "root");
    $database->get_connection();

    $controller = new PostController();
    $controller->process_request($_SERVER["REQUEST_METHOD"], $id);
?>