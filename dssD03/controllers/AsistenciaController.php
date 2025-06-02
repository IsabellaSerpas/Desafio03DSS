<?php
class AsistenciaController {
    private $grupo;
    private $estudiante;
    private $asistencia;
    private $aspecto;

    public function __construct($db) {
        date_default_timezone_set('America/El_Salvador');

        $this->grupo      = new Grupo($db);
        $this->estudiante = new Estudiante($db);
        $this->asistencia = new Asistencia($db);
        $this->aspecto    = new Aspecto($db);
    }

    public function index() {
        $modoDesarrollo = true;

        if (!$modoDesarrollo) {
            $this->verificarHorarioPermitido();
        }

        if (empty($_SESSION['codigo_tutor'])) {
            return $this->mostrarError("Debe iniciar sesión como tutor");
        }

        $codigoTutor = $_SESSION['codigo_tutor'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarFormulario($codigoTutor);
            $mensaje = "Asistencia y aspectos registrados correctamente";
        }

        $this->mostrarVistaAsistencia($codigoTutor);
    }

    private function verificarHorarioPermitido() {
        $diaSemana = date('w');  // 0 = domingo, 6 = sábado
        $hora      = date('H');

        if ($diaSemana !== '6' || $hora < 8 || $hora >= 11) {
            $this->mostrarError("Solo puede tomar asistencia los sábados de 8:00am a 11:00am");
        }
    }

    private function procesarFormulario($codigoTutor) {
        $asistencias = $_POST['asistencia'] ?? [];
        foreach ($asistencias as $codigoEstudiante => $tipo) {
            $this->asistencia->marcar($codigoEstudiante, $codigoTutor, $tipo);
        }

        $aspectos = $_POST['aspectos'] ?? [];
        foreach ($aspectos as $codigoEstudiante => $aspectosEstudiante) {
            foreach ($aspectosEstudiante as $codigoAspecto) {
                if (!empty($codigoAspecto)) {
                    $this->aspecto->asignar($codigoAspecto, $codigoEstudiante, $codigoTutor);
                }
            }
        }
    }

    private function mostrarVistaAsistencia($codigoTutor) {
        $grupo = $this->grupo->obtenerPorTutor($codigoTutor);

        if (!$grupo) {
            return $this->mostrarError("No se encontró el grupo asignado al tutor");
        }

        $estudiantes = $this->estudiante->obtenerPorGrupo($grupo['id']);
        $aspectos    = $this->aspecto->obtenerTodos();

        include 'views/asistencia/index.php';
    }

    private function mostrarError($mensaje) {
        $error = $mensaje;
        include 'views/error.php';
    }
}
?>
