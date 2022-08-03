<?php
    //headers
    // use * to allowing anyone without the problem about authentication 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application.json');

    //initializing our api
    //to load our pathes
    include_once('../core/initialize.php');

    //instantiate post
    $post = new Post($db);

    //blog post query
    $result = $post->read();
    
?>