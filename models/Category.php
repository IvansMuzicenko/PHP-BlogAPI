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

        public function create() {
            $query = 'INSERT INTO ' 
                . $this->table . '
            SET
                name = :name';

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));

            $stmt->bindParam(':name', $this->name);

            if ($stmt->execute()) {
                return true;
            }

            printf("Error: $stmt->error.\n");

            return false;
        }
    }