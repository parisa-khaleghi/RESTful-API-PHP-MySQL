<?php

    class Post{
        // //sb stuff
        // private $conn;
        // private $table = 'posts';

        // //post properties
        // public $id;
        // public $category_id;
        // public $category_name;
        // public $title;
        // public $body;
        // public $author;
        // public $create_at;

        public function process_request(string $method, ? string $id) : void{
            if($id){
                $this->process_resource_request($method, $id);
            } else {
                $this->process_collection_request($method);
            }
        }

        public function process_resource_request(string $method, string $id) : void{
        
        }

        public function process_collection_request(string $method) : void{
            switch($method){
                case "GET":
                    echo json_encode(["id" => "123"]);
                    break;
            }
        }
    }
?>