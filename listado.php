<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
  <?php
  require "funcionamiento/conexion.php";
  include "funcionamiento/elementos.php";
  include "funcionamiento/querysR.php";
  include "funcionamiento/querysCUD.php";

  $accion = array_key_exists('accion', $_GET) ? $_GET['accion'] : "";
  $accion == "Crear" ? crearPro($_GET) : "";
  $accion == "Actualizar" ? actualizarPro($_GET) : "";
  $accion == "Borrar" ? borrarPro($_GET) : "";

  if ($accion == "Error_id") {
    crearAlerta("danger", "<b>Error:</b> El ID no coincide con ningún Producto");
  }

  $productos = obtenerPros();
  ?>

  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Gestión de Productos</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-1">
        <form method="GET" action="formulario.php">
          <div class="d-grid gap-2">
            <input type="hidden" name="accion" value="Crear">
            <input type="submit" value="Crear" class="btn btn-success">
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-striped align-middle text-center">
          <thead>
            <tr>
              <th>Detalle</th>
              <th>Código</th>
              <th>Nombre</th>
              <th colspan="2">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($productos as $clave => $valor) {
              echo "<tr>";
              echo "<td>";
              crearBoton("Detalle", "info", "detalle.php", $valor['id']);
              echo "</td>";
              echo "<th>" . $valor['id'] . "</th>";
              echo "<td>" . $valor['nombre'] . "</td>";
              echo "<td>";
              crearBoton("Actualizar", "warning", "formulario.php", $valor['id']);
              echo "</td>";
              echo "<td>";
              crearBoton("Borrar", "danger", "listado.php", $valor['id']);
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>