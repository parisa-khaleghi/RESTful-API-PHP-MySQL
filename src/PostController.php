<?php

    class PostController{

        private PostGateway $gateway;
        public function __construct(PostGateway $gateway){
            $this->gateway = $gateway;
        }

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
                    echo json_encode($this->gateway->get_all());
                    break;
                case "POST":
                    $data = json_decode(file_get_contents("php://input"), true);
                    var_dump($data);
                    break;
            }
        }
    }
?>