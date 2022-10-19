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
  include "funcionamiento/querysR.php";

  $accion = $_GET['accion'];
  $id = array_key_exists('id', $_GET) ? $_GET['id'] : "";
  $producto = obtenerPro($id);
  print_r($producto);
  ?>

  <div class="container">
    <br>
    <!-- ENCABEZADO -->
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Detalle Producto</h1>
      </div>
    </div>

    <div class="row">
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>