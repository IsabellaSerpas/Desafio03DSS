<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
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
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 3rem 1rem;
    }

    .card {
      background-color: white;
      border: none;
      border-radius: 1.25rem;
      box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-title {
      color: #b83280;
      font-weight: bold;
    }

    .btn-primary {
      background: linear-gradient(90deg, #ff85a2, #d16ba5);
      border: none;
    }

    .btn-success {
      background: linear-gradient(90deg, #a18cd1, #fbc2eb);
      border: none;
      color: #fff;
    }

    .btn:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark px-4">
    <a class="navbar-brand" href="#">Academia</a>
    <div class="ms-auto">
      <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
    </div>
  </nav>

  <div class="main-content">
    <div class="row w-100 justify-content-center g-4">
      <div class="col-md-5 col-lg-4">
        <div class="card text-center p-4">
          <h5 class="card-title">Gestión de Grupos</h5>
          <p class="card-text">Crear y administrar grupos de estudiantes</p>
          <a href="grupos.php" class="btn btn-primary w-100">Ir a Grupos</a>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card text-center p-4">
          <h5 class="card-title">Reportes</h5>
          <p class="card-text">Generar reportes trimestrales</p>
          <a href="reportes.php" class="btn btn-success w-100">Ver Reportes</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
