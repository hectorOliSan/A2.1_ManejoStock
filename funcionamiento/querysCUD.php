<?php

function crearPro($producto)
{
  global $conexion;
  $query = $conexion->prepare("INSERT INTO productos (
    nombre, nombre_corto, descripcion, pvp, familia) VALUES (?,?,?,?,?);");
  $query->execute([$producto['nombre'], $producto['nombre_corto'],
    $producto['descripcion'], $producto['pvp'], $producto['familia']]);
  crearAlerta("success", "El producto se ha <b>Creado</b> correctamente");
}

function actualizarPro($producto)
{
  global $conexion;
  obtenerPro($producto['id']);
  $query = $conexion->prepare("UPDATE productos
    SET nombre=?, nombre_corto=?, descripcion=?, pvp=?, familia=? WHERE id=?");
  $query->execute([$producto['nombre'], $producto['nombre_corto'],
    $producto['descripcion'], $producto['pvp'], $producto['familia'], $producto['id']]);
  crearAlerta("success", "El producto se ha <b>Actualizado</b> correctamente");
}

function borrarPro($producto)
{
  global $conexion;
  obtenerPro($producto['id']);
  $query = $conexion->prepare("DELETE FROM productos WHERE id=?");
  $query->execute([$producto['id']]);
  crearAlerta("success", "El producto se ha <b>Borrado</b> correctamente");
}