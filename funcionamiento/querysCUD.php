<?php

function crearPro($producto)
{
  global $conexion;
  if (
    sizeof($producto) != 6
    || !array_key_exists('accion', $producto)
    || !array_key_exists('nombre', $producto)
    || !array_key_exists('nombre_corto', $producto)
    || !array_key_exists('descripcion', $producto)
    || !array_key_exists('pvp', $producto)
    || !array_key_exists('familia', $producto)
  ) {
    header('Location:listado.php?accion=Error_param&tipo=Crear');
  } else {
    $query = $conexion->prepare("INSERT INTO productos (
    nombre, nombre_corto, descripcion, pvp, familia) VALUES (?,?,?,?,?);");
    $query->execute([
      $producto['nombre'], $producto['nombre_corto'],
      $producto['descripcion'], $producto['pvp'], $producto['familia']
    ]);
    crearAlerta("success", "El producto se ha <b>Creado</b> correctamente");
  }
}

function actualizarPro($producto)
{
  global $conexion;
  if (
    sizeof($producto) != 7
    || !array_key_exists('accion', $producto)
    || !array_key_exists('id', $producto)
    || !array_key_exists('nombre', $producto)
    || !array_key_exists('nombre_corto', $producto)
    || !array_key_exists('descripcion', $producto)
    || !array_key_exists('pvp', $producto)
    || !array_key_exists('familia', $producto)
  ) {
    header('Location:listado.php?accion=Error_param&tipo=Actualizar');
  } else {
    obtenerPro($producto['id']);
    $query = $conexion->prepare("UPDATE productos
    SET nombre=?, nombre_corto=?, descripcion=?, pvp=?, familia=? WHERE id=?");
    $query->execute([
      $producto['nombre'], $producto['nombre_corto'],
      $producto['descripcion'], $producto['pvp'], $producto['familia'], $producto['id']
    ]);
    crearAlerta("success", "El producto se ha <b>Actualizado</b> correctamente");
  }
}

function borrarPro($producto)
{
  global $conexion;
  if (
    sizeof($producto) != 2
    || !array_key_exists('accion', $producto)
    || !array_key_exists('id', $producto)
  ) {
    header('Location:listado.php?accion=Error_param&tipo=Borrar');
  } else {
    obtenerPro($producto['id']);
    $query = $conexion->prepare("DELETE FROM productos WHERE id=?");
    $query->execute([$producto['id']]);
    crearAlerta("success", "El producto se ha <b>Borrado</b> correctamente");
  }
}
