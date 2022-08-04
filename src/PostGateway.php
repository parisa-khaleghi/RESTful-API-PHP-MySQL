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
                // $row["is_available"] = (bool) $row["is_available"];
                $data[$i] = $row;
                $i++;
            }

            return $data;
        }

        public function create(array $data): string
        {
            $sql = "INSERT INTO ".$this->table." (title, body, author, category_id)
                    VALUES (:title, :body, :author, :category_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':title', $data["title"], PDO::PARAM_STR);
            $stmt->bindValue(':body', $data["body"], PDO::PARAM_STR);
            $stmt->bindValue(':author', $data["author"], PDO::PARAM_STR);
            $stmt->bindValue(':category_id', $data["category_id"], PDO::PARAM_STR);

            $stmt->execute();

            return $this->conn->lastInsertId();
        }

        public function get(int $id)
        {
            $sql = "SELECT * 
                    FROM ".$this->table." 
                    WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            return $data;       
        }

    }

?>