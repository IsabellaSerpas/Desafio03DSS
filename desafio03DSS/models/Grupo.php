<?php
require_once "database.php";

class Grupo {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function crear($nombre, $codigo_tutor) {
        $query = "INSERT INTO grupos (nombre, codigo_tutor) VALUES (:nombre, :codigo_tutor)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":codigo_tutor", $codigo_tutor);
        return $stmt->execute();
    }

    public function asignarEstudiante($id_grupo, $codigo_estudiante) {
        $query = "INSERT INTO estudiantes_grupo (id_grupo, codigo_estudiante) VALUES (:id_grupo, :codigo_estudiante)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":id_grupo", $id_grupo);
        $stmt->bindParam(":codigo_estudiante", $codigo_estudiante);
        return $stmt->execute();
    }
}
?>