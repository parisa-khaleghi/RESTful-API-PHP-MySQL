<?php

    class Category{
        //sb stuff
        private $conn;
        private $table = 'categories';

        //category properties
        public $id;
        public $name;
        public $create_at;

        // intitialize this class or particular class
        //constructor with db connection
        public function __construct($db){
            $this->conn = $db;
        }

        //getting categories from our database
        public function read(){
            //create query
            $query = 'SELECT * FROM '.$this->table;

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        public function read_single(){
            //create query
            $query = 'SELECT * FROM '.$this->table.' 
                       WHERE p.id = ? LIMIT 1 ';

            //prepare statement
            $stmt = $this->conn->prepare($query);
            //binding param
            $stmt->bindParam(1, $this->id);
            //execute query
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
            $this->created_at = $row['created_at'];
        }

        public function create(){
            //create query
            $query = 'INSERT INTO '.$this->table.' SET name= :name';
            //prepare statement
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->name   = htmlspecialchars(strip_tags($this->name));
            //binding all parameters
            $stmt->bindParam(':name', $this->name);
            //execute query
            if($stmt->execute()){
                return true;
            }
            //print if something goes wrong
            printf('Errro %s.\n', $stmt->error);
            return false;
        }
        
        //update category function
        public function update(){
            //create query
            $query = 'UPDATE '.$this->table.' 
                      SET name= :name
                      WHERE id = :id';
            //prepare statement
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->name         = htmlspecialchars(strip_tags($this->name));
            $this->id   = htmlspecialchars(strip_tags($this->id));
            //binding all parameters
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);
            //execute query
            if($stmt->execute()){
                return true;
            }
            //print if something goes wrong
            printf('Errro %s.\n', $stmt->error);
            return false;
        }
        //delete function
        public function delete(){
            //create query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
            //prepare statement
            $stmt = $this->conn->prepare($query);
            //clean data
            $this->id   = htmlspecialchars(strip_tags($this->id));
            //binding all parameters
            $stmt->bindParam(':id', $this->id);
            //execute query
            if($stmt->execute()){
                return true;
            }
            //print if something goes wrong
            printf('Errro %s.\n', $stmt->error);
            return false;
        }
    }
?>