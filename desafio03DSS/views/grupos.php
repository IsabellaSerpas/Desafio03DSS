<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/database.php';

// Verificar que sea un administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== "administrador") {
    header("Location: dashboard.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Creación de grupos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crear_grupo"])) {
    $nombre_grupo = $_POST['nombre_grupo'];
    $codigo_tutor = $_POST['codigo_tutor'];

    $query = "INSERT INTO grupos (nombre, codigo_tutor) VALUES (:nombre, :codigo_tutor)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nombre_grupo);
    $stmt->bindParam(':codigo_tutor', $codigo_tutor);

    if ($stmt->execute()) {
        $mensaje = "Grupo creado exitosamente.";
    } else {
        $mensaje = "Error al crear el grupo.";
    }
}

// actualiza de grupos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["guardar_edicion"])) {
    $id_grupo = $_POST["id_grupo"];
    $nuevo_nombre = $_POST["nuevo_nombre"];
    $nuevo_tutor = $_POST["nuevo_tutor"];

    $query = "UPDATE grupos SET nombre = :nombre, codigo_tutor = :codigo_tutor WHERE id = :id_grupo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nuevo_nombre);
    $stmt->bindParam(':codigo_tutor', $nuevo_tutor);
    $stmt->bindParam(':id_grupo', $id_grupo);

    $mensaje = $stmt->execute() ? "Grupo actualizado correctamente." : "Error al actualizar el grupo.";
}

// elimina estudiantes de grupos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_estudiante"])) {
    $codigo_estudiante = $_POST["codigo_estudiante"];

    $query = "DELETE FROM grupo_estudiantes WHERE codigo_estudiante = :codigo_estudiante";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);

    if ($stmt->execute()) {
        $mensaje = "Estudiante eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el estudiante.";
    }
}

// elimina grupos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar_grupo"])) {
    $id_grupo = $_POST["id_grupo"];

    $query = "DELETE FROM grupos WHERE id = :id_grupo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_grupo', $id_grupo);

    if ($stmt->execute()) {
        $mensaje = "Grupo eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el grupo.";
    }
}

// asigna estudiantes a grupos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar_estudiante"])) {
    $id_grupo = $_POST["id_grupo"];
    $codigo_estudiante = $_POST["codigo_estudiante"];

    // limita el número de estudiantes a 20 
    $queryCount = "SELECT COUNT(*) AS total FROM grupo_estudiantes WHERE id_grupo = :id_grupo";
    $stmtCount = $db->prepare($queryCount);
    $stmtCount->bindParam(":id_grupo", $id_grupo);
    $stmtCount->execute();
    $resultCount = $stmtCount->fetch(PDO::FETCH_ASSOC);

    if ($resultCount["total"] >= 20) {
        $mensaje = "No se pueden agregar más estudiantes. Límite de 20 alcanzado.";
    } else {
        // verifica que no se repita el estudiante en el grupo
        $queryInsert = "INSERT IGNORE INTO grupo_estudiantes (id_grupo, codigo_estudiante) VALUES (:id_grupo, :codigo_estudiante)";
        $stmtInsert = $db->prepare($queryInsert);
        $stmtInsert->bindParam(":id_grupo", $id_grupo);
        $stmtInsert->bindParam(":codigo_estudiante", $codigo_estudiante);

        if ($stmtInsert->execute()) {
            $mensaje = "Estudiante agregado exitosamente.";
        } else {
            $mensaje = "Error al agregar estudiante.";
        }
    }
}

// Obtiene lista de grupos
$queryGrupos = "SELECT g.id, g.nombre, t.nombres AS tutor_nombre, t.apellidos AS tutor_apellidos 
                FROM grupos g 
                LEFT JOIN tutores t ON g.codigo_tutor = t.codigo";
$stmtGrupos = $db->prepare($queryGrupos);
$stmtGrupos->execute();
$grupos = $stmtGrupos->fetchAll(PDO::FETCH_ASSOC);

// Obtiene lista de tutores
$queryTutores = "SELECT codigo, nombres, apellidos FROM tutores";
$stmtTutores = $db->prepare($queryTutores);
$stmtTutores->execute();
$tutores = $stmtTutores->fetchAll(PDO::FETCH_ASSOC);

// Obtiene lista de estudiantes
$queryEstudiantes = "SELECT codigo, nombres, apellidos FROM estudiantes";
$stmtEstudiantes = $db->prepare($queryEstudiantes);
$stmtEstudiantes->execute();
$estudiantes = $stmtEstudiantes->fetchAll(PDO::FETCH_ASSOC);

// Obtiene lista de estudiantes por grupo
$queryGrupoEstudiantes = "SELECT ge.id_grupo, e.codigo, e.nombres, e.apellidos 
                          FROM grupo_estudiantes ge 
                          JOIN estudiantes e ON ge.codigo_estudiante = e.codigo 
                          ORDER BY ge.id_grupo";
$stmtGrupoEstudiantes = $db->prepare($queryGrupoEstudiantes);
$stmtGrupoEstudiantes->execute();
$grupoEstudiantes = $stmtGrupoEstudiantes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Grupos - Academia</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/layouts/header.php'; ?>

    <header>
        <h1>Administrar Grupos</h1>
    </header>

    <nav>
        <a href="dashboard.php">Inicio</a>
        <a href="../views/reporte_trimestral.php">Reportes</a>
    </nav>

    <div class="grupos-container">
        <h2>Crear Nuevo Grupo</h2>
        <form method="POST" action="grupos.php">
            <label for="nombre_grupo">Nombre del Grupo:</label>
            <input type="text" name="nombre_grupo" id="nombre_grupo" required>

            <label for="codigo_tutor">Asignar Tutor:</label>
            <select name="codigo_tutor" id="codigo_tutor" required>
                <option value="">Seleccionar Tutor</option>
                <?php foreach ($tutores as $tutor) : ?>
                    <option value="<?php echo $tutor['codigo']; ?>">
                        <?php echo $tutor['nombres'] . " " . $tutor['apellidos']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="submit" name="crear_grupo" value="Crear Grupo">
        </form>

        <h2>Agregar Estudiantes a un Grupo</h2>
        <form method="POST" action="grupos.php">
            <label for="id_grupo">Seleccionar Grupo:</label>
            <select name="id_grupo" id="id_grupo" required>
                <option value="">Selecciona un Grupo</option>
                <?php foreach ($grupos as $grupo) : ?>
                    <option value="<?php echo $grupo['id']; ?>">
                        <?php echo $grupo['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="codigo_estudiante">Seleccionar Estudiante:</label>
            <select name="codigo_estudiante" id="codigo_estudiante" required>
                <option value="">Seleccionar Estudiante</option>
                <?php foreach ($estudiantes as $estudiante) : ?>
                    <option value="<?php echo $estudiante['codigo']; ?>">
                        <?php echo $estudiante['nombres'] . " " . $estudiante['apellidos']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="submit" name="agregar_estudiante" value="Agregar Estudiante">
        </form>
        <?php if (isset($mensaje)) : ?>
            <p style="color: green;"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>
         <h2>Lista de Grupos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tutor</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($grupos as $grupo) : ?>
                <tr id="grupo-<?php echo $grupo['id']; ?>">
                    <td><?php echo htmlspecialchars($grupo['id']); ?></td>
                    <td><?php echo htmlspecialchars($grupo['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($grupo['tutor_nombre'] . " " . $grupo['tutor_apellidos']); ?></td>
                    <td>
                        <button onclick="mostrarEdicion(<?php echo $grupo['id']; ?>)">Editar</button>
                    </td>
                </tr>
                <tr id="editar-<?php echo $grupo['id']; ?>" style="display: none;">
                    <form method="POST" action="grupos.php">
                        <td><?php echo htmlspecialchars($grupo['id']); ?></td>
                        <td><input type="text" name="nuevo_nombre" value="<?php echo htmlspecialchars($grupo['nombre']); ?>" required></td>
                        <td>
                            <select name="nuevo_tutor" required>
                                <option value="">Seleccionar Tutor</option>
                                <?php foreach ($tutores as $tutor) : ?>
                                <option value="<?php echo $tutor['codigo']; ?>">
                                <?php echo $tutor['nombres'] . " " . $tutor['apellidos']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id_grupo" value="<?php echo $grupo['id']; ?>">
                            <input type="submit" name="guardar_edicion" value="Guardar">
                        </td>
                        <td>
                            <form method="POST" action="grupos.php">
                                <input type="hidden" name="id_grupo" value="<?php echo $grupo['id']; ?>">
                                <input type="submit" name="eliminar_grupo" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                            </form>
                        </td>

                    </form>
                </tr>
            <?php endforeach; ?>
        </table>

       
 

        <h2>Lista de Estudiantes por Grupo</h2>
        <?php foreach ($grupos as $grupo) : ?>
            <h3><?php echo htmlspecialchars($grupo['nombre']); ?> (Tutor: <?php echo htmlspecialchars($grupo['tutor_nombre'] . " " . $grupo['tutor_apellidos']); ?>)</h3>
            <table>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
                <?php
                $found = false;
                foreach ($grupoEstudiantes as $estudiante) :
                    if ($estudiante['id_grupo'] == $grupo['id']) :
                        $found = true;
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($estudiante['codigo']); ?></td>
                            <td><?php echo htmlspecialchars($estudiante['nombres']); ?></td>
                            <td><?php echo htmlspecialchars($estudiante['apellidos']); ?></td>
                        </tr>

                         <td>
                            <form method="POST" action="grupos.php">
                                <input type="hidden" name="codigo_estudiante" value="<?php echo $estudiante['codigo']; ?>">
                                <input type="submit" name="eliminar_estudiante" value="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                            </form>
                        </td>


                <?php endif; endforeach; ?>
                <?php if (!$found) : ?>
                    <tr><td colspan="3" style="text-align: center; color: gray;">No hay estudiantes en este grupo.</td></tr>
                <?php endif; ?>
            </table>
        <?php endforeach; ?>
    </div>
    <script>
        function mostrarEdicion(id) {
            document.getElementById("grupo-" + id).style.display = "none";
            document.getElementById("editar-" + id).style.display = "table-row";
        }

        document.addEventListener("DOMContentLoaded", function() {
            const botonesEditar = document.querySelectorAll("button.editar-grupo");

            botonesEditar.forEach(boton => {
                boton.addEventListener("click", function() {
                    const idGrupo = boton.dataset.id;
                    document.getElementById("grupo-" + idGrupo).style.display = "none";
                    document.getElementById("editar-" + idGrupo).style.display = "table-row";
                });
            });
        });
    </script>
</body>
</html>