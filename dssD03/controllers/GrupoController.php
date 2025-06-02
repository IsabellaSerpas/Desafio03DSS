<?php

require_once 'models/Tutor.php';

class GrupoController {
    private $grupo;
    private $tutor;
    private $estudiante;

    public function __construct($db) {
        $this->grupo = new Grupo($db);
        $this->tutor = new Tutor($db);
        $this->estudiante = new Estudiante($db);
    }

    public function index() {
        $grupos = $this->grupo->obtenerTodos();
        include 'views/grupos/index.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarCreacion();
        }

        // Obtener solo los tutores que no tienen grupo asignado
        $tutores = $this->tutor->obtenerTutoresSinGrupo();
        include 'views/grupos/crear.php';
    }

    private function procesarCreacion() {
        $nombre = $_POST['nombre'] ?? '';
        $codigo_tutor = $_POST['codigo_tutor'] ?? '';

        if ($this->grupo->crear($nombre, $codigo_tutor)) {
            header("Location: grupos.php");
            exit();
        }
    }

    public function asignar($grupo_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarAsignacion($grupo_id);
        }

        // Obtener estudiantes asignados y disponibles
        $estudiantesAsignados = $this->grupo->obtenerEstudiantesPorGrupo($grupo_id);
        $estudiantesDisponibles = $this->estudiante->obtenerEstudiantesSinGrupo();
        $cantidad_actual = $this->grupo->contarEstudiantesPorGrupo($grupo_id);

        include 'views/grupos/asignar.php';
    }

    private function procesarAsignacion($grupo_id) {
        $estudiantes = $_POST['estudiantes'] ?? [];

        // Obtener la cantidad actual de estudiantes en el grupo
        $cantidad_actual = $this->grupo->contarEstudiantesPorGrupo($grupo_id);

        // Verificar si el grupo ha alcanzado el límite de 20
        if ($cantidad_actual + count($estudiantes) > 20) {
            echo "<script>alert('El grupo ya tiene el número máximo de estudiantes (20). No se pueden agregar más.');</script>";
            return;
        }

        // Asignar estudiantes si hay espacio disponible
        foreach ($estudiantes as $codigo_estudiante) {
            $this->grupo->asignarEstudiante($grupo_id, $codigo_estudiante);
        }

        header("Location: asignar.php?grupo_id=" . $grupo_id);
        exit();
    }

    public function eliminar($id) {
        $this->grupo->eliminar($id);
        header("Location: grupos.php");
        exit();
    }
}
?>