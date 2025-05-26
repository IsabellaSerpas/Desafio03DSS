<?php
require_once "../models/Asistencia.php";
session_start();

class AsistenciaController {
    private $asistencia;

    public function __construct() {
        $this->asistencia = new Asistencia();
    }

    public function registrarAsistencia($datos) {
        if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'tutor') {
            die("Acceso denegado.");
        }

        foreach ($datos as $registro) {
            $fecha = date("Y-m-d");
            $codigo_estudiante = $registro['codigo_estudiante'];
            $codigo_tutor = $_SESSION['usuario'];
            $tipo = $registro['tipo'];

            $this->asistencia->registrar($codigo_estudiante, $codigo_tutor, $fecha, $tipo);
        }
        
        header("Location: ../views/asistencia.php?mensaje=Registrado");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new AsistenciaController();
    $controller->registrarAsistencia($_POST['asistencia']);
}
?>