// models/Asistencia.php
<?php
require_once "Database.php";

class Asistencia {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registrar($codigo_estudiante, $codigo_tutor, $fecha, $tipo) {
        $query = "INSERT INTO asistencias (fecha, codigo_estudiante, codigo_tutor, tipo) VALUES (:fecha, :codigo_estudiante, :codigo_tutor, :tipo)";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":codigo_estudiante", $codigo_estudiante);
        $stmt->bindParam(":codigo_tutor", $codigo_tutor);
        $stmt->bindParam(":tipo", $tipo);
        return $stmt->execute();
    }

    public function obtenerPorTrimestre($codigo_estudiante, $trimestre) {
        $fechaInicio = date("Y-m-d", strtotime("-{$trimestre} months"));
        $fechaFin = date("Y-m-d", strtotime("-" . ($trimestre - 3) . " months"));
        $query = "SELECT * FROM asistencias WHERE codigo_estudiante = :codigo_estudiante AND fecha BETWEEN :inicio AND :fin";
        $stmt = $this->db->conn->prepare($query);
        $stmt->bindParam(":codigo_estudiante", $codigo_estudiante);
        $stmt->bindParam(":inicio", $fechaInicio);
        $stmt->bindParam(":fin", $fechaFin);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>