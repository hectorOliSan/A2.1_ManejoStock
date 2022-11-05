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
    try {
      $query = $conexion->prepare("INSERT INTO productos (
        nombre, nombre_corto, descripcion, pvp, familia) VALUES (?,?,?,?,?);");
      $query->execute([
        $producto['nombre'], $producto['nombre_corto'],
        $producto['descripcion'], $producto['pvp'], $producto['familia']
      ]);
      crearAlerta("success", "El producto se ha <b>Creado</b> correctamente");
    } catch (Exception $e) {
      crearAlerta("danger", "Error al <b>Crear</b> Producto: " . $e);
    }
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
    try {
      obtenerPro($producto['id']);
      $query = $conexion->prepare("UPDATE productos
      SET nombre=?, nombre_corto=?, descripcion=?, pvp=?, familia=? WHERE id=?");
      $query->execute([
        $producto['nombre'], $producto['nombre_corto'],
        $producto['descripcion'], $producto['pvp'], $producto['familia'], $producto['id']
      ]);
      crearAlerta("success", "El producto se ha <b>Actualizado</b> correctamente");
    } catch (Exception $e) {
      crearAlerta("danger", "Error al <b>Actualizar</b> Producto: " . $e);
    }
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
    try {
      obtenerPro($producto['id']);
      $query = $conexion->prepare("DELETE FROM productos WHERE id=?");
      $query->execute([$producto['id']]);
      crearAlerta("success", "El producto se ha <b>Borrado</b> correctamente");
    } catch (Exception $e) {
      crearAlerta("danger", "Error al <b>Borrar</b> Producto: " . $e);
    }
  }
}

function moverStock($transaccion)
{
  global $conexion;
  if (
    sizeof($transaccion) != 5
    || !array_key_exists('tienda', $transaccion)
    || !array_key_exists('nueva_tienda', $transaccion)
    || !array_key_exists('unidades', $transaccion)
    || !array_key_exists('accion', $transaccion)
    || !array_key_exists('id', $transaccion)
  ) {
    header('Location:listado.php?accion=Error_param&tipo=Mover+Stock');
  } else {
    try {
      $conexion->beginTransaction();
      $stock = obtenerStock($transaccion['id'], $transaccion['nueva_tienda']);
      if ($stock == null) {
        $conexion->exec("INSERT INTO stocks (producto, tienda, unidades)
          VALUES (" . $transaccion['id'] . ", " . $transaccion['nueva_tienda'] .
          ", " . $transaccion['unidades'] . ");");
      } else {
        $conexion->exec("UPDATE stocks SET unidades = unidades + " . $transaccion['unidades'] .
          " WHERE producto = " . $transaccion['id'] . " AND tienda = " . $transaccion['nueva_tienda'] . ";");
      }
      $conexion->exec("UPDATE stocks SET unidades = unidades - " . $transaccion['unidades'] .
        " WHERE producto = " . $transaccion['id'] . " AND tienda = " . $transaccion['tienda'] . ";");
      $conexion->commit();
      crearAlerta("success", "Transacción de <b>Mover Stock</b> completado correctamente");
    } catch (Exception $e) {
      $conexion->rollback();
      crearAlerta("danger", "Error de Transacción al <b>Mover Stock</b>: " . $e);
    }
  }
}
