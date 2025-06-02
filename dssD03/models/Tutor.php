<?php
class Tutor {
    private $conn;
    private $table = 'tutores';

    public function __construct($db) {
        $this->conn = $db;
    }

    /* 
     * Obtiene todos los tutores con estado 'contratado' 
     */
    public function obtenerTodos() {
        $query = "SELECT * FROM {$this->table} WHERE estado = 'contratado'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* 
     * Obtiene un tutor por su código 
     */
    public function obtenerPorCodigo($codigo) {
        $query = "SELECT * FROM {$this->table} WHERE codigo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* 
     * Obtiene solo los tutores que no tienen un grupo asignado 
     */
    public function obtenerTutoresSinGrupo() {
        $query = "SELECT * FROM {$this->table} 
                  WHERE estado = 'contratado' 
                  AND codigo NOT IN (SELECT codigo_tutor FROM grupos)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>