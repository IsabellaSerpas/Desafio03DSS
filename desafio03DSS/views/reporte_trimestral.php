<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/pdf.php';
require_once __DIR__ . '/../helpers/semaforo.php';

// Verificar que el usuario sea administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Obtener lista de estudiantes activos
$queryEstudiantes = "SELECT codigo, nombres, apellidos FROM estudiantes WHERE estado = 'activo'";
$stmtEstudiantes = $db->prepare($queryEstudiantes);
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

// Procesar generación de reporte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_estudiante = $_POST['codigo_estudiante'];
    $trimestre = $_POST['trimestre'];

    // Obtener datos del estudiante
    $queryDatos = "SELECT nombres, apellidos FROM estudiantes WHERE codigo = :codigo";
    $stmtDatos = $db->prepare($queryDatos);
    $stmtDatos->bindParam(':codigo', $codigo_estudiante);
    $stmtDatos->execute();
    $estudiante = $stmtDatos->fetch(PDO::FETCH_ASSOC);

    // Calcular rango de fechas para el trimestre
    $inicioMes = ($trimestre - 1) * 3 + 1;
    $finMes = $inicioMes + 2;

    // Obtener asistencia y disciplina del trimestre
    $queryAsistencia = "SELECT tipo FROM asistencias WHERE codigo_estudiante = :codigo AND MONTH(fecha) BETWEEN :inicio AND :fin";
    $stmtAsistencia = $db->prepare($queryAsistencia);
    $stmtAsistencia->bindParam(':codigo', $codigo_estudiante);
    $stmtAsistencia->bindParam(':inicio', $inicioMes, PDO::PARAM_INT);
    $stmtAsistencia->bindParam(':fin', $finMes, PDO::PARAM_INT);
    $stmtAsistencia->execute();
    $inasistencias = $stmtAsistencia->fetchAll(PDO::FETCH_COLUMN);

    $queryAspectos = "SELECT tipo FROM asignacion_aspectos WHERE codigo_estudiante = :codigo AND MONTH(fecha) BETWEEN :inicio AND :fin";
    $stmtAspectos = $db->prepare($queryAspectos);
    $stmtAspectos->bindParam(':codigo', $codigo_estudiante);
    $stmtAspectos->bindParam(':inicio', $inicioMes, PDO::PARAM_INT);
    $stmtAspectos->bindParam(':fin', $finMes, PDO::PARAM_INT);
    $stmtAspectos->execute();
    $aspectos = $stmtAspectos->fetchAll(PDO::FETCH_COLUMN);

    // Calcular el semáforo
    $tipoSemaforo = obtenerSemaforo(
        count(array_filter($aspectos, fn($a) => $a === "L")),
        count(array_filter($inasistencias, fn($i) => $i === "I")),
        count(array_filter($aspectos, fn($a) => $a === "G")),
        count(array_filter($aspectos, fn($a) => $a === "MG"))
    );

    // Generar PDF
    generarReportePDF($estudiante['nombres'] . " " . $estudiante['apellidos'], $codigo_estudiante, $trimestre, $inasistencias, $aspectos, $tipoSemaforo);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Trimestral - Academia</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/layouts/header.php'; ?>

    <header>
        <h1>Generar Reporte Trimestral</h1>
    </header>

    <nav>
        <a href="dashboard.php">Inicio</a>
        <a href="../views/grupos.php">Administrar Grupos</a>
    </nav>

    <div class="reportes-container">
        <h2>Seleccione Estudiante y Trimestre</h2>
        <form method="POST" action="reporte_trimestral.php">
            <label for="codigo_estudiante">Estudiante:</label>
            <select name="codigo_estudiante" id="codigo_estudiante" required>
                <option value="">Seleccionar Estudiante</option>
                <?php foreach ($estudiantes as $estudiante) : ?>
                    <option value="<?php echo $estudiante['codigo']; ?>">
                        <?php echo htmlspecialchars($estudiante['nombres'] . " " . $estudiante['apellidos']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="trimestre">Trimestre:</label>
            <select name="trimestre" id="trimestre" required>
                <option value="1">Primer Trimestre</option>
                <option value="2">Segundo Trimestre</option>
                <option value="3">Tercer Trimestre</option>
            </select>

            <input type="submit" value="Generar Reporte">
        </form>
    </div>
</body>
</html>