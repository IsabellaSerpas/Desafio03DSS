<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Grupos</title>
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

        .section-title {
            color: #b83280;
            font-weight: bold;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .group-name {
            font-size: 1.25rem;
            font-weight: bold;
            color: #a14ebf;
        }

        .tutor-name {
            font-size: 1rem;
            color: #5c3c63;
        }

        .btn-primary {
            background: linear-gradient(90deg, #ff85a2, #d16ba5);
            border: none;
            font-weight: 500;
        }

        .btn-danger {
            background: linear-gradient(90deg, #ff758c, #ff7eb3);
            border: none;
            color: white;
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.9rem;
        }

        .btn:hover {
            opacity: 0.9;
        }
        
        .btn-crear {
        background: linear-gradient(90deg, #ff85a2, #d16ba5);
        border: none;
        color: white;
        font-weight: 500;
    }

    .btn-crear:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        background-color: #ddd;
        border: none;
        color: #333;
        font-weight: 500;
    }
    .btn-success{
     background: linear-gradient(90deg, #ff85a2, #d16ba5);
      border: none;
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

<div class="main-content container">
    <div class="section-title">Crear nuevo grupo</div>

    <div class="main-content">
        <div class="form-card">
            <form method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Grupo</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="codigo_tutor" class="form-label">Tutor</label>
                    <select class="form-control" name="codigo_tutor" required>
                        <option value="">Seleccionar tutor...</option>
                        <?php foreach($tutores as $tutor): ?>
                            <option value="<?= $tutor['codigo'] ?>"><?= $tutor['nombres'] . ' ' . $tutor['apellidos'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Crear Grupo</button>
                    <a href="grupos.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
