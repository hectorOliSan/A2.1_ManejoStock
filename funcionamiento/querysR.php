<?php

function obtenerPros()
{
  global $conexion;
  try {
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
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Productos: " . $e);
  }
}

function obtenerPro($id)
{
  global $conexion;
  try {
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
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Producto(" . $id . "): " . $e);
  }
}

function obtenerFam()
{
  global $conexion;
  try {
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
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Familias: " . $e);
  }
}

function obtenerProFam($pFam)
{
  global $conexion;
  try {
    $query = $conexion->query("SELECT * FROM familias WHERE cod = '" . $pFam . "';");
    $resultado = $query->fetch(PDO::FETCH_OBJ);
    return array(
      "cod" => $resultado->cod,
      "nombre" => $resultado->nombre
    );
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Familia(" . $pFam . "): " . $e);
  }
}

function obtenerStock($id, $tienda)
{
  global $conexion;
  try {
    $query = $conexion->query(
      "SELECT * FROM stocks
      WHERE producto='" . $id . "' AND tienda='" . $tienda . "';"
    );
    $resultado = $query->fetch(PDO::FETCH_OBJ);
    return $resultado;
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Stock del Producto(" . $id . "): " . $e);
  }
}

function obtenerProStock($id)
{
  global $conexion;
  try {
    $stock = array();
    $query = $conexion->query(
      "SELECT tiendas.id, tiendas.nombre, stocks.unidades
      FROM tiendas
      JOIN stocks ON tiendas.id = stocks.tienda
      JOIN productos ON productos.id = stocks.producto
      WHERE productos.id = '" . $id . "' AND stocks.unidades > 0
      ORDER BY tiendas.nombre;"
    );
    $resultado = $query->fetch(PDO::FETCH_OBJ);
    while ($resultado != null) {
      array_push($stock, array(
        "tienda_id" => $resultado->id,
        "tienda" => $resultado->nombre,
        "unidades" => $resultado->unidades
      ));
      $resultado = $query->fetch(PDO::FETCH_OBJ);
    }
    return $stock;
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Tiendas y Stock del Producto(" . $id . "): " . $e);
  }
}

function obtenerTienda($tienda_id)
{
  global $conexion;
  try {
    $tiendas = array();
    $query = $conexion->query(
      "SELECT * FROM tiendas
      WHERE id != '" . $tienda_id . "';"
    );
    $resultado = $query->fetch(PDO::FETCH_OBJ);
    while ($resultado != null) {
      array_push($tiendas, array(
        "id" => $resultado->id,
        "nombre" => $resultado->nombre,
        "tlf" => $resultado->tlf
      ));
      $resultado = $query->fetch(PDO::FETCH_OBJ);
    }
    return $tiendas;
  } catch (Exception $e) {
    crearAlerta("danger", "Error al <b>Obtener</b> Tienda(" . $tienda_id . "): " . $e);
  }
}

function obtenerUsuario($user, $pw)
{
  global $conexion;
  try {
    $usuarios = array();
    $query = $conexion->query("SELECT *
      FROM usuarios WHERE usuario = '" . $user . "' AND
      clave = '" . $pw . "';");
    $resultado = $query->fetch(PDO::FETCH_OBJ);
    while ($resultado != null) {
      array_push($usuarios, array(
        "usuario" => $resultado->usuario,
        "clave" => $resultado->clave,
        "nombrecompleto" => $resultado->nombrecompleto,
        "correo" => $resultado->correo,
        "colorfondo" => $resultado->colorfondo,
        "tipoletra" => $resultado->tipoletra,
      ));
      $resultado = $query->fetch(PDO::FETCH_OBJ);
    }
    return $usuarios;
  } catch (Exception $e) {
    echo "<p>Error al <b>Obtener</b> Usuarios: " . $e . ".</p>";
  }
}
