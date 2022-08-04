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
            $post = $this->gateway->get($id);
            echo json_encode($post);
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

        private function get_validation_errors(array $data): array
        {
            $errors = [];
            $i = 0;

            if(empty($data["title"])){
                $errors[$i] = "title is required.";
                $i++;
            }

            if(empty($data["body"])){
                $errors[$i] = "body is required.";
                $i++;
            }

            if(empty($data["author"])){
                $errors[$i] = "author is required.";
                $i++;
            }

            if(empty($data["category_id"])){
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
            // https://www.php.net/manual/en/filter.filters.validate.php

            return $errors;
        }
    }
?>