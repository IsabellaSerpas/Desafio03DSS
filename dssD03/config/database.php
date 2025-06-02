<?php
class Database {
    private $conn;
    private $host     = 'localhost';
    private $db_name  = 'academia';
    private $username = 'root';
    private $password = '';

    public function getConnection() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name}";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            $this->conn = null;
        }

        return $this->conn;
    }
}
?>
