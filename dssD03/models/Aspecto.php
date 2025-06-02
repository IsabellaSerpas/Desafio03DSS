<?php
class Aspecto {
    private $conn;
    private $table = 'aspectos';

    public function __construct($db) {
        $this->conn = $db;
    }

    /*
     * Obtiene todos los aspectos ordenados por tipo y descripción 
     */
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY tipo, descripcion";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Asigna un aspecto a un estudiante con el tutor correspondiente 
     */
    public function asignar($codigo_aspecto, $codigo_estudiante, $codigo_tutor) {
        $query = "INSERT INTO asignacion_aspectos (codigo_aspecto, fecha, codigo_estudiante, codigo_tutor) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$codigo_aspecto, date('Y-m-d'), $codigo_estudiante, $codigo_tutor]);
    }

    /* 
     * Obtiene los aspectos asignados a un estudiante en un trimestre 
     */
    public function obtenerPorEstudianteTrimestre($codigo_estudiante, $trimestre, $ano = null) {
        $ano = $ano ?? date('Y');
        $fechas = $this->calcularFechasTrimestre($trimestre, $ano);

        $query = "SELECT aa.*, a.descripcion, a.tipo FROM asignacion_aspectos aa 
                  INNER JOIN aspectos a ON aa.codigo_aspecto = a.id 
                  WHERE aa.codigo_estudiante = ? AND aa.fecha BETWEEN ? AND ?
                  ORDER BY aa.fecha";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo_estudiante, $fechas['inicio'], $fechas['fin']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Calcula las fechas de inicio y fin de un trimestre 
     */
    private function calcularFechasTrimestre($trimestre, $ano) {
        switch ($trimestre) {
            case 1:
                return ['inicio' => "$ano-02-01", 'fin' => "$ano-04-30"];
            case 2:
                return ['inicio' => "$ano-05-01", 'fin' => "$ano-07-31"];
            case 3:
                return ['inicio' => "$ano-08-01", 'fin' => "$ano-10-31"];
            default:
                return ['inicio' => "$ano-01-01", 'fin' => "$ano-12-31"];
        }
    }
}
?>