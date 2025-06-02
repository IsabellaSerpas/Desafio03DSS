<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f8d1ff, #e0c3fc);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(90deg, #c471ed, #f64f59);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .main-content {
            flex: 1;
            padding: 3rem 1rem;
        }

        .form-card {
            max-width: 600px;
            margin: auto;
            background-color: white;
            border-radius: 1.25rem;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-title {
            color: #b83280;
            font-weight: bold;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.75rem;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-generar {
            background: linear-gradient(90deg, #a18cd1, #fbc2eb);
            border: none;
            font-weight: bold;
            color: white;
        }

        .btn-generar:hover {
            opacity: 0.9;
        }

        .btn-volver {
            margin-top: 1.5rem;
            background-color: #6c757d;
            color: white;
            font-weight: 500;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-volver:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand" href="dashboard.php">Academia</a>
    <div class="ms-auto">
        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
    </div>
</nav>

<div class="main-content">
    <div class="form-card">
        <div class="form-title">Generar Reporte Trimestral</div>

        <form method="post">
            <div class="mb-3">
                <label for="codigo_estudiante" class="form-label">Estudiante</label>
                <select class="form-select" name="codigo_estudiante" required>
                    <option value="">Seleccionar estudiante...</option>
                    <?php foreach($estudiantes as $estudiante): ?>
                        <option value="<?= $estudiante['codigo'] ?>">
                            <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="trimestre" class="form-label">Trimestre</label>
                <select class="form-select" name="trimestre" required>
                    <option value="">Seleccionar trimestre...</option>
                    <option value="1">Primer Trimestre (Feb - Abr)</option>
                    <option value="2">Segundo Trimestre (May - Jul)</option>
                    <option value="3">Tercer Trimestre (Ago - Oct)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-generar w-100 py-2">Generar PDF</button>
        </form>
    </div>
</div>

</body>
</html>
