<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Productos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css" />

</head>

<body>
  <?php
  require "funcionamiento/conexion.php";
  include "funcionamiento/elementos.php";
  include "funcionamiento/querysR.php";
  include "funcionamiento/querysCUD.php";

  !empty($_GET) && !array_key_exists('accion', $_GET) ? header('Location:listado.php') : "";
  $accion = array_key_exists('accion', $_GET) ? $_GET['accion'] : "";
  $accion == "Crear" ? crearPro($_GET) : "";
  $accion == "Actualizar" ? actualizarPro($_GET) : "";
  $accion == "Borrar" ? borrarPro($_GET) : "";

  if ($accion == "Error_id") {
    crearAlerta("danger", "<b>Error:</b> El ID no coincide con ningún Producto");
  }

  if ($accion == "Error_param") {
    $tipo = array_key_exists('tipo', $_GET) ? $_GET['tipo'] : header('Location:listado.php');
    crearAlerta("danger", "<b>Error:</b> Los parámetros para <b>" . $tipo . "</b>, no son los apropiados");
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
    <br>
    <div class="row">
      <div class="col-12">
        <table id="listado" class="display table table-striped align-middle text-center">
          <thead>
            <tr>
              <th class="text-center">Detalle</th>
              <th class="text-center">Código</th>
              <th class="text-center">Nombre</th>
              <th></th>
              <th class="text-center">Acciones</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($productos as $clave => $valor) {
              echo "<tr>";
              echo "<td>";
              crearBoton("Detalle", "info", "detalle.php", $valor['id']);
              echo "</td>";
              echo "<td>" . $valor['id'] . "</td>";
              echo "<td>" . $valor['nombre'] . "</td>";
              echo "<td>";
              crearBoton("Actualizar", "warning", "formulario.php", $valor['id']);
              echo "</td>";
              echo "<td>";
              crearBoton("Borrar", "danger", "listado.php", $valor['id']);
              echo "</td>";
              echo "<td>";
              crearBoton("Mover Stock", "primary", "moverstock.php", $valor['id']);
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
  <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js" integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.js" defer></script>
  <script>
    $(document).ready(function() {
      $('#listado').DataTable({
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ productos",
          info: "Mostrando de _START_ a _END_ de _TOTAL_ productos",
          infoEmpty: "Mostrando 0 productos",
          infoFiltered: "(filtrado de _MAX_ productos totales)",
          zeroRecords: "No hay productos para mostrar",
          emptyTable: "No hay datos disponibles",
          paginate: {
            previous: "<i class='bi bi-arrow-left-short'></i>",
            next: "<i class='bi bi-arrow-right-short'></i>",
          }
        }
      });
    });
  </script>
</body>

</html>