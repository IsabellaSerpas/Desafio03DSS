<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['usuario'])) { // Verificar si no hay usuario activo
    header("Location: ../login.php");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<header class="header">
    <div class="header-container">
        <h1>Academia</h1>
        <div class="user-info">
            <p>Bienvenido, <strong><?php echo htmlspecialchars($usuario); ?></strong></p>
            <a href="../helpers/session.php?action=logout" class="logout-btn">Cerrar Sesión</a>
        </div>
    </div>
</header>