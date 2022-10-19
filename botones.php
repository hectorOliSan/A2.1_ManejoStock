<?php
function crearBoton($accion, $btn, $php, $id)
{
  echo "<form method='GET' action='".$php."'>";
  echo "<div class='d-grid gap-2'>";
  echo "<input type='hidden' name='accion' value='".$accion."'>";
  echo "<input type='hidden' name='id' value='".$id."'>";
  echo "<input type='submit' value='".$accion."' class='btn btn-".$btn."'>";
  echo "</div>";
  echo "</form>";
}