<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar el usuario para cargar el dashboard
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol']; // Esto determinará qué contenido se muestra
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Academia</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>

    <?php include __DIR__ . '/layouts/header.php'; ?>

    <nav>
        <a href="../views/dashboard.php">Inicio</a>
        <?php if ($rol === "tutor") : ?>
            <a href="../views/asistencia.php">Pasar Asistencia</a>
        <?php endif; ?>
        
    </nav>

    <div class="dashboard-container">
        <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?></h2>
        <p>Selecciona una opción del menú para administrar el sistema.</p>

        <div class="dashboard-grid">
            <?php if ($rol === "tutor") : ?>
                <div class="card">
                    <h3>Asistencia</h3>
                    <p>Registra la asistencia de tu grupo.</p>
                    <a href="../views/asistencia.php"><button>Ir a Asistencia</button></a>
                </div>
            <?php endif; ?>

            <?php if ($rol === "administrador") : ?>
                <div class="card">
                    <h3>Grupos</h3>
                    <p>Gestiona los grupos de estudiantes.</p>
                    <a href="../views/grupos.php"><button>Administrar Grupos</button></a>
                </div>

                <div class="card">
                    <h3>Reportes</h3>
                    <p>Genera y consulta reportes trimestrales.</p>
                    <a href="../views/reporte_trimestral.php"><button>Ver Reportes</button></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>