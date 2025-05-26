<?php
session_start();

function iniciarSesion($usuario, $rol) {
    $_SESSION["usuario"] = $usuario;
    $_SESSION["rol"] = $rol;
}

function cerrarSesion() {
    session_unset();
    session_destroy();
    header("Location: ../public/index.php"); // Redirigir correctamente
    exit();
}

// Detectar acción en la URL
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    cerrarSesion();
}
?>