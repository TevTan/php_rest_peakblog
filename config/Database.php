<?php
    class Database {
        // DB Params (parameters)

        //private: use for this class only
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = '';
        private $conn; //for connection

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' .$e->getMessage(); //tell why can't connect
            }

            return $this->conn;
        }

    }
?>