<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio Sesión</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="font-monospace">
  <?php
  include "funcionamiento/elementos.php";

  session_start();
  session_destroy();
  setcookie("PHPSESSID", "", time() - 1000, "/");

  empty($_GET) ? $_GET['error'] = "" : "";
  if ($_GET['error'] == "user_pass") {
    crearAlerta("danger", "Usuario o Contraseña <b>incorrectos</b>");
  }

  if ($_GET['error'] == "sesion") {
    crearAlerta("danger", "Debes <b>iniciar sesión</b>");
  }
  ?>
  <p class="fs-1 text-center pt-5 pb-3">Inicia Sesión</p>
  <form action="listado.php" method="POST">
    <div class="col-6 mx-auto">
      <p class="m-0 fs-5">Usuario:</p>
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
        <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
      </div>
    </div>

    <div class="col-6 mx-auto">
      <p class="m-0 fs-5">Contraseña:</p>
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        <input type="password" class="form-control" name="clave" placeholder="Contraseña" required>
      </div>
    </div>

    <button class="m-5 d-block mx-auto btn btn-primary" type="submit">Iniciar</button>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>