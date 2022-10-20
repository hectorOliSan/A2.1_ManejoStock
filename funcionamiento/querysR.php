<?php

function obtenerPros()
{
  global $conexion;
  $productos = array();
  $query = $conexion->query("SELECT id, nombre FROM productos;");
  $resultado = $query->fetch(PDO::FETCH_OBJ);
  while ($resultado != null) {
    array_push($productos, array(
      "id" => $resultado->id,
      "nombre" => $resultado->nombre
    ));
    $resultado = $query->fetch(PDO::FETCH_OBJ);
  }
  return $productos;
}

function obtenerPro($id)
{
  global $conexion;
  $query = $conexion->query("SELECT * FROM productos WHERE id = '" . $id . "';");
  $resultado = $query->fetch(PDO::FETCH_OBJ);
  $resultado == null ? header('Location:listado.php?accion=Error_id') : "";
  return array(
    "id" => $resultado->id,
    "nombre" => $resultado->nombre,
    "nombre_corto" => $resultado->nombre_corto,
    "descripcion" => $resultado->descripcion,
    "pvp" => $resultado->pvp,
    "familia" => $resultado->familia
  );
}

function obtenerFam()
{
  global $conexion;
  $queryF = $conexion->query("SELECT cod, nombre FROM familias;");
  $resultadoF = $queryF->fetch(PDO::FETCH_OBJ);
  $familias = array();
  while ($resultadoF != null) {
    array_push($familias, array(
      "cod" => $resultadoF->cod,
      "nombre" => $resultadoF->nombre
    ));
    $resultadoF = $queryF->fetch(PDO::FETCH_OBJ);
  }
  return $familias;
}

function obtenerProFam($pFam)
{
  global $conexion;
  $query = $conexion->query("SELECT * FROM familias WHERE cod = '" . $pFam . "';");
  $resultado = $query->fetch(PDO::FETCH_OBJ);
  return array(
    "cod" => $resultado->cod,
    "nombre" => $resultado->nombre
  );
}
