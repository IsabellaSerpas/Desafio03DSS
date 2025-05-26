<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirigir al dashboard solo si el usuario ya está autenticado
if (isset($_SESSION['usuario'])) {
    header("Location: ../views/dashboard.php");
    exit();
}

// Verificar si hubo intento de login con error
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once __DIR__ . '/../config/database.php';

    $username = $_POST['usuario']; 
    $password = $_POST['clave'];  

    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM usuarios WHERE username = :username";  // Corrección de columna
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) { // Corrección de campo
        $_SESSION['usuario'] = $user['username']; 
        $_SESSION['rol'] = $user['rol']; 

        header("Location: ../views/dashboard.php");
        exit();
    } else {
        $message = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Academia</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Bienvenido a la Academia</h2>
        <p>Por favor, inicia sesión para continuar.</p>

        <form class="login-form" method="POST" action="index.php">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required>

            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave" required>

            <?php if (!empty($message)) : ?>
                <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <input type="submit" name="login" value="Ingresar">
        </form>
    </div>
</body>
</html>