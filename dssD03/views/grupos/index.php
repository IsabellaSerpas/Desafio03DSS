<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Grupos</title>
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

        .card {
            background-color: white;
            border: none;
            border-radius: 1.25rem;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .card-title {
            color: #b83280;
            font-weight: bold;
            text-align: center;
            font-size: 1.8rem;
        }

        .btn-crear {
            background: linear-gradient(90deg, #ff85a2, #d16ba5);
            border: none;
            color: white;
            font-weight: bold;
        }

        .btn-crear:hover {
            opacity: 0.9;
        }

        .btn-warning, .btn-danger {
            font-weight: bold;
        }

        .btn-volver {
            margin-top: 2rem;
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

        .table thead {
            background-color: #f0f0f0;
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
    <div class="card">
        <h2 class="card-title mb-4">Gestión de Grupos</h2>

        <div class="d-flex justify-content-between mb-4">
            <h5 class="mb-0">Lista de Grupos</h5>
            <a href="grupos.php?action=crear" class="btn btn-crear">+ Crear Grupo</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tutor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($grupos as $grupo): ?>
                    <tr>
                        <td><?= $grupo['id'] ?></td>
                        <td><?= $grupo['nombre'] ?></td>
                        <td><?= $grupo['nombres'] . ' ' . $grupo['apellidos'] ?></td>
                        <td>
                            <a href="grupos.php?action=asignar&id=<?= $grupo['id'] ?>" class="btn btn-sm btn-warning">Asignar</a>
                            <a href="grupos.php?action=eliminar&id=<?= $grupo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar grupo?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
