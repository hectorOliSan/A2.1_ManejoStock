<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Productos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
  <?php
  require "funcionamiento/conexion.php";
  include "funcionamiento/botones.php";
  include "funcionamiento/querysR.php";

  $productos = obtenerPros();

  print_r($_GET);
  ?>

  <div class="container">
    <br>
    <!-- ENCABEZADO -->
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Gestión de Productos</h1>
      </div>
    </div>
    <!-- BOTÓN CREAR -->
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
    <!<!-- TABLA -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>