<?php

    class PostGateway
    {
        private PDO $conn;
        private string $table;

        public function __construct(Database $database)
        {
            $this->conn = $database->get_connection();
            $this->table = "posts";
        }

        public function get_all(): array
        {
            $sql = "SELECT * FROM ".$this->table;

            $stmt = $this->conn->query($sql);

            $data = [];
            $i=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[$i] = $row;
                $i++;
            }

            return $data;
        }
    }

?>