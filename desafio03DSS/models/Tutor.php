// models/Tutor.php
<?php
require_once "Database.php";

class Tutor {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM tutores";
        $stmt = $this->db->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorCodigo($codigo) {
        $query = "SELECT * FROM tutores WHERE codigo = :codigo";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>