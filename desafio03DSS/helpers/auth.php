<?php
session_start();

function usuarioAutenticado() {
    return isset($_SESSION["usuario"]);
}

function esAdmin() {
    return usuarioAutenticado() && $_SESSION["rol"] === "admin";
}

function esTutor() {
    return usuarioAutenticado() && $_SESSION["rol"] === "tutor";
}

function verificarAcceso($tipoUsuario) {
    if (!usuarioAutenticado() || $_SESSION["rol"] !== $tipoUsuario) {
        die("Acceso denegado.");
    }
}
?>