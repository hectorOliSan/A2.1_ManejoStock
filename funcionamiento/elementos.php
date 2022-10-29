<?php
function crearBoton($accion, $btn, $php, $id)
{
  echo "<form method='GET' action='" . $php . "'>";
  echo "<div class='d-grid gap-2'>";
  echo "<input type='hidden' name='accion' value='" . $accion . "'>";
  echo "<input type='hidden' name='id' value='" . $id . "'>";
  echo "<input type='submit' value='" . $accion . "' class='btn btn-" . $btn . "'>";
  echo "</div>";
  echo "</form>";
}

function crearAlerta($color, $mensaje)
{
  echo "<div class='alert alert-" . $color . " alert-dismissible fade show m-3' role='alert'>";
  echo $mensaje;
  echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
  echo "</div>";
}