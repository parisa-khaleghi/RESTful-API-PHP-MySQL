<?php
    //headers
    // use * to allowing anyone without the problem about authentication 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application.json');

    //initializing our api
    //to load our pathes
    include_once('../core/initialize.php');

    //instantiate post
    $category = new Post($db);

    //blog category query
    $result = $category->read();

    //get the row count
    $num = $result->rowCount();

    if($num > 0){
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $category_item = array(
                'id' => $id,
                'name' => $name,
                'created_at' => $created_at
            );
            array_push($category_arr['data'], $category_item);
        }
        //push to 'data'
        //convert to JSON and output
        echo json_encode($category_arr);
    } else {
        echo json_encode(array('message' => 'No categories found.'));
    }
?>