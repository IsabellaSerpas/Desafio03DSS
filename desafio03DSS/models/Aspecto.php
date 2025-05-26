// models/Aspecto.php
<?php
require_once "Database.php";

class Aspecto {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerPorTrimestre($codigo_estudiante, $trimestre) {
        $fechaInicio = date("Y-m-d", strtotime("-{$trimestre} months"));
        $fechaFin = date("Y-m-d", strtotime("-" . ($trimestre - 3) . " months"));
        $query = "SELECT * FROM asignaciones_aspectos WHERE codigo_estudiante = :codigo_estudiante AND fecha BETWEEN :inicio AND :fin";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":codigo_estudiante", $codigo_estudiante);
        $stmt->bindParam(":inicio", $fechaInicio);
        $stmt->bindParam(":fin", $fechaFin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>