// models/Estudiante.php
<?php
require_once "Database.php";

class Estudiante {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerPorCodigo($codigo) {
        $query = "SELECT * FROM estudiantes WHERE codigo = :codigo";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":codigo", $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerPorGrupo($id_grupo) {
        $query = "SELECT e.* FROM estudiantes e 
                  INNER JOIN estudiantes_grupo eg ON e.codigo = eg.codigo_estudiante 
                  WHERE eg.id_grupo = :id_grupo";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":id_grupo", $id_grupo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>