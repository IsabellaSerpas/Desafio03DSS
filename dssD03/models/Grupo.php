<?php
class Grupo {
    private $conn;
    private $table = 'grupos';

    public function __construct($db) {
        $this->conn = $db;
    }

    /* 
     * Crea un nuevo grupo asignando un tutor 
     */
    public function crear($nombre, $codigo_tutor) {
        $query = "INSERT INTO {$this->table} (nombre, codigo_tutor) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nombre, $codigo_tutor]);
    }

    /* 
     * Obtiene todos los grupos con su respectivo tutor 
     */
    public function obtenerTodos() {
        $query = "SELECT g.*, t.nombres, t.apellidos FROM {$this->table} g 
                  INNER JOIN tutores t ON g.codigo_tutor = t.codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Obtiene los grupos asignados a un tutor específico 
     */
    public function obtenerPorTutor($codigo_tutor) {
        $query = "SELECT * FROM {$this->table} WHERE codigo_tutor = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo_tutor]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* 
     * Asigna un estudiante a un grupo 
     */
    public function asignarEstudiante($grupo_id, $codigo_estudiante) {
        $query = "INSERT INTO grupo_estudiantes (grupo_id, codigo_estudiante) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$grupo_id, $codigo_estudiante]);
    }

    /* 
     * Cuenta la cantidad de estudiantes asignados a un grupo 
     */
    public function contarEstudiantesPorGrupo($grupo_id) {
        $query = "SELECT COUNT(*) AS total FROM grupo_estudiantes WHERE grupo_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$grupo_id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

    /* 
     * Obtiene los estudiantes asignados a un grupo 
     */
    public function obtenerEstudiantesPorGrupo($grupo_id) {
        $query = "SELECT e.* FROM estudiantes e
                  INNER JOIN grupo_estudiantes ge ON e.codigo = ge.codigo_estudiante
                  WHERE ge.grupo_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$grupo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Elimina un grupo junto con sus estudiantes asignados 
     */
    public function eliminar($id) {
        // Primero eliminar estudiantes del grupo
        $query = "DELETE FROM grupo_estudiantes WHERE grupo_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        // Luego eliminar el grupo
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>