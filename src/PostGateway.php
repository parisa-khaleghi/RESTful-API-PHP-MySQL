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

        public function update(array $surrent, array $new): int
        {
            $sql = "UPDATE ".$this->table." 
                    SET title = :title, body = :body, author = :author, category_id = :category_id
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':title', $new["title"] ?? $surrent["title"], PDO::PARAM_STR);
            $stmt->bindValue(':body', $new["body"] ?? $surrent["body"], PDO::PARAM_STR);
            $stmt->bindValue(':author', $new["author"] ?? $surrent["author"], PDO::PARAM_STR);
            $stmt->bindValue(':category_id', $new["category_id"] ?? $surrent["category_id"], PDO::PARAM_STR);
            
            $stmt->bindValue(':id', $surrent["id"], PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount();
        }

        public function delete(int $id)
        {
            $sql = "DELETE FROM ".$this->table." WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->rowCount();
        }

    }

?>