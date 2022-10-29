<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Producto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
  <?php
  require "funcionamiento/conexion.php";
  include "funcionamiento/elementos.php";
  include "funcionamiento/querysR.php";

  $accion = $_GET['accion'] != null ? $_GET['accion'] : header('Location:listado.php');
  ($_GET['accion'] == "Crear") || ($_GET['accion'] == "Actualizar")
    ? "" : header('Location:listado.php');
  $id = array_key_exists('id', $_GET) ? $_GET['id'] : "";

  $familias = obtenerFam();

  $producto = array(
    "id" => "", "nombre" => "", "nombre_corto" => "",
    "descripcion" => "", "pvp" => "", "familia" => ""
  );
  $fam_producto = array();
  if ($accion == "Actualizar") {
    $producto = obtenerPro($id);
    $fam_producto = obtenerProFam($producto['familia']);
  }

  ?>

  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <?php echo "<h1 class='font-monospace text-center'>" . $accion . " Producto</h1>" ?>
      </div>
    </div>

    <div class="row">
      <form method="GET" action="listado.php">
        <?php
        if ($accion == "Actualizar")
          echo "<input type='hidden' name='id' value='" . $id . "'>";
        ?>

        <div class="row">
          <div class="col-6 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <?php echo "<input type='text' class='form-control' name='nombre' placeholder='Nombre' value='" . $producto['nombre'] . "' required>"; ?>
          </div>

          <div class="col-6 mb-3">
            <label for="nombre_corto" class="form-label">Nombre Corto</label>
            <?php echo "<input type='text' class='form-control' name='nombre_corto' placeholder='Nombre Corto' value='" . $producto['nombre_corto'] . "' required>"; ?>
          </div>
        </div>

        <div class="row">
          <div class="col-6 mb-3">
            <label for="precio" class="form-label">Precio (€)</label>
            <?php echo "<input type='number' class='form-control' name='pvp' min=0.10 step='0.01' placeholder='Precio' value='" . $producto['pvp'] . "' required>"; ?>
          </div>
          <div class="col-6 mb-3">
            <label for="familia" class="form-label">Familia</label>
            <select class="form-select" name="familia" required>
              <?php
              if ($accion == "Actualizar")
                echo "<option value='" . $fam_producto['cod'] . "' selected hidden>" . $fam_producto['nombre'] . "</option>";
              foreach ($familias as $clave => $valor)
                echo "<option value='" . $valor['cod'] . "'>" . $valor['nombre'] . "</option>";
              ?>
            </select>
          </div>
        </div>

        <div class="col-12 mb-3">
          <label for="descripción" class="form-label">Descripción</label>
          <?php echo "<textarea class='form-control' name='descripcion' rows='15' required>" . $producto['descripcion'] . "</textarea>" ?>
        </div>

        <?php echo "<input name='accion' type='hidden' value='" . $accion . "'>" ?>

        <div class="row">
          <?php echo "<input class='col-1 m-1 btn btn-success' type='submit' value='" . $accion . "'>" ?>
          <?php
          if ($accion == "Crear")
            echo "<input class='col-1 m-1 btn btn-danger' type='reset' value='Limpiar'>";
          ?>
          <a class="col-1 m-1 btn btn-secondary" href="listado.php">Volver</a>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>