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
            $current_data = $this->gateway->get($id);
            if(!$current_data){
                http_response_code(404);
                echo json_encode([
                    "message" => str_replace("Controller", "", get_class())." not found."
                ]);
                return;
            }

            switch($method){
                case "GET":
                    echo json_encode($current_data);
                    break;
                case "PATCH":
                    $data = (array) json_decode(file_get_contents("php://input"), true);
                    $errors = $this->get_validation_errors($data, false);
                    if(!empty($errors)){
                        http_response_code(422);
                        echo json_encode(["errors" => $errors]);
                        break;
                    }
                    $rows = $this->gateway->update($current_data, $data);
                    echo json_encode([
                        "message" => str_replace("Controller", "", get_class())." $id updated.",
                        "rows" => $rows
                    ]); 
                    break;
            }
        }

        public function process_collection_request(string $method) : void{
            switch($method){
                case "GET":
                    echo json_encode($this->gateway->get_all());
                    break;
                case "POST":
                    $data = (array) json_decode(file_get_contents("php://input"), true);
                    $errors = $this->get_validation_errors($data);
                    if(!empty($errors)){
                        http_response_code(422);
                        echo json_encode(["errors" => $errors]);
                        break;
                    }
                    $id = $this->gateway->create($data);
                    http_response_code(201);
                    echo json_encode([
                        "message" => str_replace("Controller", "", get_class())." created.",
                        "id" => $id
                    ]);
                    break;
                default:
                    http_response_code(405);
                    header("Allow: GET, POST");
                
            }
        }

        private function get_validation_errors(array $data, bool $is_new=true): array
        {
            $errors = [];
            $i = 0;

            if($is_new == true && empty($data["title"])){
                var_dump($is_new);
                $errors[$i] = "title is required.";
                $i++;
            }

            if($is_new == true && empty($data["body"])){
                $errors[$i] = "body is required.";
                $i++;
            }

            if($is_new == true && empty($data["author"])){
                $errors[$i] = "author is required.";
                $i++;
            }

            if($is_new == true && empty($data["category_id"])){
                $errors[$i] = "category_id is required.";
                $i++;
            }
            //for optional data
            //if(array_key_exists("title", $data)) {}

            // to check the size
            //  if(filter_var($data["title"], FITER_VALIDATE_INT) === false) {
            //     $errors[$i] = "title must be an integer.";
            //     $i++;
            //  }
            // FITER_VALIDATE => https://www.php.net/manual/en/filter.filters.validate.php

            return $errors;
        }
    }
?>