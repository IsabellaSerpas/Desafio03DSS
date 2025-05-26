// models/Usuario.php
<?php
require_once "Database.php";

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function autenticar($usuario, $clave) {
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($clave, $result['clave'])) {
            return $result; 
        }
        return false;
    }
}
?>