<?php
class Estudiante {
    private $conn;
    private $table = 'estudiantes';

    public function __construct($db) {
        $this->conn = $db;
    }

    /* 
     * Obtiene todos los estudiantes activos 
     */
    public function obtenerTodos() {
        $query = "SELECT * FROM {$this->table} WHERE estado = 'activo'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Obtiene un estudiante por su código 
     */
    public function obtenerPorCodigo($codigo) {
        $query = "SELECT * FROM {$this->table} WHERE codigo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
     * Obtiene los estudiantes asignados a un grupo 
     */
    public function obtenerPorGrupo($grupo_id) {
        $query = "SELECT e.* FROM {$this->table} e 
                  INNER JOIN grupo_estudiantes ge ON e.codigo = ge.codigo_estudiante 
                  WHERE ge.grupo_id = ? AND e.estado = 'activo'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$grupo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Obtiene estudiantes que no están asignados a un grupo 
     */
    public function obtenerEstudiantesSinGrupo() {
        $query = "SELECT * FROM {$this->table} WHERE codigo NOT IN (SELECT codigo_estudiante FROM grupo_estudiantes)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>