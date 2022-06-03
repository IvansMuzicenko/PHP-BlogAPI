<?php 
    class Category{
        private $conn;
        private $table = 'categories';

        public $id;
        public $name;
        public $created_at;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
            $query = 'SELECT
                id,
                name,
                created_at
            FROM
                ' . $this->table . '
            ORDER BY 
                created_at DESC';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function read_single() {
            $query = 'SELECT
                id,
                name,
                created_at
            FROM
                ' . $this->table . '
            WHERE
                id = :id
            LIMIT 0,1';

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":id", $this->id);

            $stmt->execute();

            return $stmt;
        }
    }