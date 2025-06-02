<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(to right, #f8d1ff, #e0c3fc);
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .page-container {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
    }

    .navbar {
        background: linear-gradient(90deg, #c471ed, #f64f59);
        height: 80px;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff !important;
    }

    .nav-link {
        color: #ffe5f2 !important;
        font-weight: 500;
    }

    .section-title-bar {
        background: linear-gradient(90deg, #ff85a2, #d16ba5);
        color: white;
        padding: 2rem 1rem;
        font-size: 2rem;
        font-weight: bold;
        text-align: center;
        width: 100%;
        border-radius: 0 0 1rem 1rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05);
    }

    .assign-card {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 1.25rem;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .assign-card:hover {
        transform: translateY(-5px);
    }

    .form-check-label {
        font-weight: 500;
        color: #7b3d8f;
    }

    .btn-success {
        background: linear-gradient(90deg, #a18cd1, #fbc2eb);
        border: none;
        font-weight: bold;
        color: white;
        border-radius: 0.5rem;
    }

    .btn-secondary {
        background: linear-gradient(90deg, #f5d0ec, #dab6fc);
        border: none;
        font-weight: bold;
        color: #5e336f;
        border-radius: 0.5rem;
    }

    .btn:hover {
        opacity: 0.9;
    }
    </style>
</head>
<body>
<div class="page-container">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">ACADEMIA</a>
            <div class="d-flex">
                <a class="nav-link" href="grupos.php">Grupos</a>
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar">
        ASIGNAR ESTUDIANTES AL GRUPO
    </div>

    <div class="main-content">
        <div class="assign-card">
            <form method="post">
                <div class="mb-4">
                    <label for="estudiantes" class="form-label">Selecciona los estudiantes:</label>

                    <!-- Muestra mensaje de alerta si el grupo está lleno -->
                    <?php if ($cantidad_actual >= 20): ?>
                        <div class="alert alert-danger text-center">
                            Este grupo ya tiene el número máximo de estudiantes (20).
                        </div>
                    <?php endif; ?>

                    <select class="form-select" name="estudiantes[]" id="estudiantes" multiple size="10" 
                        <?= ($cantidad_actual >= 20) ? 'disabled' : '' ?>>
                        <?php foreach ($estudiantesDisponibles as $estudiante): ?>
                            <option value="<?= $estudiante['codigo'] ?>">
                                <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Mantén presionada la tecla Ctrl para seleccionar múltiples estudiantes.</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success" <?= ($cantidad_actual >= 20) ? 'disabled' : '' ?>>
                        Asignar Estudiantes
                    </button>
                    <a href="grupos.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>