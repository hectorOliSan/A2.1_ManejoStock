<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfi Usuario</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<?php
require "funcionamiento/conexion.php";
include "funcionamiento/elementos.php";
include "funcionamiento/querysR.php";
include "funcionamiento/querysCUD.php";
session_start();
if (empty($_SESSION)) include 'funcionamiento/inicio_sesion.php';
include 'funcionamiento/datos_sesion.php';
?>

<body style="background-color: <?php echo $colorfondo ?>; font-family: <?php echo $tipoletra ?>;">
  <?php
  $php = empty($_POST) ? "listado.php" : $_POST['php'];
  $accion = array_key_exists('accion', $_POST) ? $_POST['accion'] : "";
  $id = array_key_exists('id', $_POST) ? $_POST['id'] : "";

  if (array_key_exists('actualizar_sesion', $_POST)) {
    actualizar_sesion(
      $_POST['nombrecompleto'],
      $_POST['correo'],
      $_POST['colorfondo'],
      $_POST['tipoletra']
    );
    actualizarUsuario($_SESSION['usuario'], $_POST);
  }

  ?>

  <div class="d-flex justify-content-between align-items-center p-3">
    <div class="d-flex align-items-center">
      <a href="index.php" class="mx-2 btn btn-sm btn-danger"><i class="bi bi-power"></i></a>
      <p class="m-0">Cerrar Sesión</p>
    </div>
  </div>

  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Perfil Usuario</h1>
      </div>
    </div>

    <div class="row">
      <form method="POST" action="perfil.php">
        <input type="hidden" name="actualizar_sesion" value="1">
        <input type="hidden" name="php" value="<?php echo $php; ?>">
        <?php if ($accion != "") { ?>
          <input type="hidden" name="accion" value="<?php echo $accion; ?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>

        <div class="mb-3">
          <label for="nombrecompleto" class="form-label">Nombre y Apellidos:</label>
          <?php echo "<input type='text' class='form-control'
            name='nombrecompleto' placeholder='Escribe tu nombre Nombre y Apellidos...'
            value='" . $nombrecompleto . "' maxlength='200' required>"; ?>
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo:</label>
          <?php echo "<input type='email' class='form-control'
            name='correo' placeholder='Escribe tu correo...'
            value='" . $correo . "' maxlength='50' required>"; ?>
        </div>
        <br>
        <hr><br>
        <div class="col-6 mx-auto">
          <label for="tipoletra" class="form-label">Tipo de letra:</label>
          <select class="form-select" name="tipoletra" required>
            <option value="<?php echo $tipoletra; ?>" selected hidden><?php echo $tipoletra; ?></option>;
            <option value="Consolas">Consolas</option>;
            <option value="Arial">Arial</option>;
            <option value="Serif">Serif</option>;
          </select>
        </div>
        <div class="m-5 d-flex justify-content-center">
          <label for="colorfondo" class="mx-2 form-label">Color de fondo:</label>
          <div class="col-1">
            <?php echo "<input type='color' class='p-0 form-control'
            name='colorfondo' value='" . $colorfondo . "' required>"; ?>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="col-4 btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>

    <div class="m-3 d-flex justify-content-center">
      <form method="GET" action="<?php echo $php; ?>">
        <?php if ($accion != "") { ?>
          <input type="hidden" name="accion" value="<?php echo $accion; ?>">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php } ?>
        <button type="submit" class="btn btn-secondary">Volver</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>