<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers/semaforo.php';

// Verificar si el usuario tiene rol de tutor
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== "tutor") {
    die("Error: No tienes permisos para acceder a esta página.");
}

$database = new Database();
$db = $database->getConnection();


// Obtiene la lista de estudiantes del grupo asignado al tutor
$queryEstudiantes = "SELECT e.codigo, e.nombres, e.apellidos 
                     FROM estudiantes e 
                     JOIN grupo_estudiantes ge ON e.codigo = ge.codigo_estudiante 
                     JOIN grupos g ON ge.id_grupo = g.id";
$stmtEstudiantes = $db->prepare($queryEstudiantes);
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

// Verificar si la consulta devolvió resultados
if (!$estudiantes) {
    echo "Error: \"No hay estudiantes asignados a este tutor.\"";

    exit();
}

// Procesa asistencia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['asistencia'])) {
    $tutor_codigo = $_SESSION['codigo'];
    foreach ($_POST['asistencia'] as $codigo_estudiante => $tipo) {
        $queryAsistencia = "INSERT INTO asistencias (fecha, codigo_estudiante, codigo_tutor, tipo) 
                            VALUES (CURDATE(), :codigo_estudiante, :codigo_tutor, :tipo)";
        $stmtAsistencia = $db->prepare($queryAsistencia);
        $stmtAsistencia->bindParam(':codigo_estudiante', $codigo_estudiante);
        $stmtAsistencia->bindParam(':codigo_tutor', $tutor_codigo); // ✅ Ahora incluye el parámetro faltante
        $stmtAsistencia->bindParam(':tipo', $tipo);
        echo "<pre>";
print_r([
    'consulta' => $queryAsistencia,
    'codigo_estudiante' => $codigo_estudiante,
    'codigo_tutor' => $tutor_codigo,
    'tipo' => $tipo
]);
echo "</pre>";
exit();

        $stmtAsistencia->execute();
    }
}

//historial de asistencia y calcular semáforo
$estado_disciplina = [];
foreach ($estudiantes as $estudiante) {
    $codigo_estudiante = $estudiante['codigo'];

    //historial de disciplina
    $queryAspectos = "SELECT tipo FROM asignacion_aspectos WHERE codigo_estudiante = :codigo";
    $stmtAspectos = $db->prepare($queryAspectos);
    $stmtAspectos->bindParam(':codigo', $codigo_estudiante);
    $stmtAspectos->execute();
    $aspectos = $stmtAspectos->fetchAll(PDO::FETCH_COLUMN);

    // Obtener registro de inasistencias
    $queryInasistencias = "SELECT tipo FROM asistencias WHERE codigo_estudiante = :codigo";
    $stmtInasistencias = $db->prepare($queryInasistencias);
    $stmtInasistencias->bindParam(':codigo', $codigo_estudiante);
    $stmtInasistencias->execute();
    $inasistencias = $stmtInasistencias->fetchAll(PDO::FETCH_COLUMN);

    // Calcular semáforo
    $estado_disciplina[$codigo_estudiante] = obtenerSemaforo(
        count(array_filter($aspectos, fn($a) => $a == "L")),
        count(array_filter($inasistencias, fn($i) => $i == "I")),
        count(array_filter($aspectos, fn($a) => $a == "G")),
        count(array_filter($aspectos, fn($a) => $a == "MG"))
    );
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia - Academia</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header>
        <h1>Registro de Asistencia</h1>
    </header>

    <nav>
        <a href="dashboard.php">Inicio</a>
        <a href="../helpers/session.php?action=logout">Cerrar Sesión</a>
    </nav>

    <div class="asistencia-container">
        <h2>Lista de Estudiantes</h2>
        <form method="POST" action="asistencia.php">
            <table class="table-container">
                <tr>
                    <th>Estudiante</th>
                    <th>Asistencia</th>
                    <th>Estado Disciplina</th>
                </tr>
                <?php foreach ($estudiantes as $estudiante) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($estudiante['nombres'] . " " . $estudiante['apellidos']); ?></td>
                        <td>
                           <select name="asistencia[<?php echo $estudiante['codigo']; ?>]" required>
                                <option value="A">Asistencia</option>
                                <option value="I">Inasistencia</option>
                                <option value="J">Justificada</option>
                            </select>
                        </td>
                        <td class="semaforo <?php echo strtolower($estado_disciplina[$estudiante['codigo']]); ?>">
                            <?php echo $estado_disciplina[$estudiante['codigo']]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <input type="submit" value="Registrar Asistencia">
        </form>
    </div>

    <?php include __DIR__ . '/layouts/header.php'; ?>
</body>
</html>