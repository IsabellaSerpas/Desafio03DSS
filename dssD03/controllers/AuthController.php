<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuario;

    public function __construct($db) {
        $this->usuario = new Usuario($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarLogin();
        } else {
            $this->mostrarFormularioLogin();
        }
    }

    private function procesarLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->usuario->login($username, $password)) {
            $this->iniciarSesion();
            $this->redireccionarUsuario();
        } else {
            $error = "Credenciales incorrectas";
            include 'views/login.php';
        }
    }

    private function iniciarSesion() {
        session_start();
        $_SESSION['user_id']       = $this->usuario->id;
        $_SESSION['username']      = $this->usuario->username;
        $_SESSION['tipo']          = $this->usuario->tipo;
        $_SESSION['codigo_tutor']  = $this->usuario->codigo_tutor;
    }

    private function redireccionarUsuario() {
        if ($this->usuario->tipo === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: asistencia.php");
        }
        exit();
    }

    private function mostrarFormularioLogin() {
        include 'views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?>
