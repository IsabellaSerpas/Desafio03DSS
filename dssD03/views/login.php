<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Iniciar sesión - Academia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f8d1ff, #d1c4ff);
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: white;
      padding: 2.5rem;
      border-radius: 1.5rem;
      box-shadow: 0 10px 30px rgba(125, 64, 168, 0.2);
      width: 100%;
      max-width: 420px;
    }

    .login-title {
      font-size: 1.9rem;
      font-weight: bold;
      color: #b83280;
      text-align: center;
      margin-bottom: 1rem;
    }

    .form-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .form-control {
      padding-left: 2.5rem;
      border-radius: 0.75rem;
      border: 1px solid #e5d0f0;
    }

    .input-icon {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #b58fcf;
    }

    .btn-login {
      background: linear-gradient(90deg, #d16ba5, #c777b9, #ba83ca);
      color: white;
      border: none;
      border-radius: 0.75rem;
      font-weight: bold;
    }

    .btn-login:hover {
      background: linear-gradient(90deg, #c850c0, #ffcc70);
    }

    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2 class="login-title">Academia Escolar</h2>

    <?php if (isset($error)) : ?>
      <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <i class="bi bi-person-fill input-icon"></i>
        <input type="text" class="form-control" name="username" id="username" placeholder="Usuario" required>
      </div>
      <div class="form-group">
        <i class="bi bi-lock-fill input-icon"></i>
        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
      </div>
      <button type="submit" class="btn btn-login w-100">Ingresar</button>
    </form>
  </div>
</body>
</html>
