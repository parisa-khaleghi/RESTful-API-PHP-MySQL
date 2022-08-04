<?php

    class PostController{

        private ProductGateway $gateway;
        public function __construct(ProductGateway $gateway){
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
            }
        }
    }
?>