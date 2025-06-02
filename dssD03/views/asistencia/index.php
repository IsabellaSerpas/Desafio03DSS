<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia - Academia</title>
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
        padding: 2rem 1rem;
    }

    .navbar {
        background: linear-gradient(90deg, #c471ed, #f64f59);
        height: 80px;
    }

    .navbar-brand {
        font-size: 1.6rem;
        font-weight: bold;
        color: white !important;
    }

    .navbar-text, .nav-link {
        color: #f8d5ec !important;
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

    .form-container {
        max-width: 900px;
        margin: 3rem auto;
        padding: 2rem;
        background: white;
        border-radius: 1.25rem;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 600;
        color: #a14ebf;
    }

    .form-select,
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #dca7d1;
    }

    .table thead {
        background-color: #fbe0f0;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .btn-primary {
        background: linear-gradient(90deg, #ff85a2, #d16ba5);
        border: none;
        font-weight: bold;
        color: white;
        letter-spacing: 0.5px;
        border-radius: 0.5rem;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    .btn-volver {
        margin-top: 1.5rem;
        background-color: #6c757d;
        color: white;
        font-weight: 500;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-volver:hover {
        background-color: #5a6268;
    }

    .alert-success {
        background-color: #f3d5eb;
        border: 1px solid #e7b4db;
        color: #6b226b;
        border-radius: 0.5rem;
    }

    .alert-warning {
        background-color: #fff3f8;
        border: 1px solid #f9c7da;
        color: #993a57;
        border-radius: 0.5rem;
    }
</style>

</head>
<body>
<div class="page-container">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">ACADEMIA - TUTOR</a>
            <div class="d-flex">
                <span class="navbar-text me-3" style= "margin-bottom:11px;">Bienvenido, <?= $_SESSION['username'] ?></span>
                <a class="nav-link" href="logout.php" style= "margin-top:9px;">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar">
        TOMAR ASISTENCIA - <?= date('d/m/Y') ?>
    </div>
    <div class="main-content">
        <div class="form-container">
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-success"><?= $mensaje ?></div>
            <?php endif; ?>

            <?php if (isset($grupo) && $grupo): ?>
                <h5 class="mb-4"><strong>Grupo:</strong> <?= $grupo['nombre'] ?></h5>
                <form method="post">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Asistencia</th>
                                    <th>Aspecto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudiantes as $estudiante): ?>
                                    <tr>
                                        <td><?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?></td>
                                        <td>
                                            <select name="asistencia[<?= $estudiante['codigo'] ?>]" class="form-select form-select-sm">
                                                <option value="A">Asistió</option>
                                                <option value="I">Inasistencia</option>
                                                <option value="J">Justificado</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="aspectos[<?= $estudiante['codigo'] ?>][]" class="form-select form-select-sm">
                                                <option value="">Sin aspecto</option>
                                                <?php foreach ($aspectos as $aspecto): ?>
                                                    <option value="<?= $aspecto['id'] ?>">[<?= $aspecto['tipo'] ?>] <?= $aspecto['descripcion'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">REGISTRAR ASISTENCIA</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning mt-3">No tienes un grupo asignado.</div>
            <?php endif; ?>
        </div>
    </div>

</div>
</body>
</html>
