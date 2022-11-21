<?php
if (!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])) {
  noAutorizado('sesion');
}

$usuario = $_SESSION['usuario'];
$clave = hash('sha256', $_SESSION['clave']);
$nombrecompleto = $_SESSION['nombrecompleto'];
$correo = $_SESSION['correo'];
$colorfondo = $_SESSION['colorfondo'];
$tipoletra = $_SESSION['tipoletra'];

function actualizar_sesion($a_nombre, $a_correo, $a_color, $a_letra)
{
  $_SESSION['nombrecompleto'] = $a_nombre;
  $_SESSION['correo'] = $a_correo;
  $_SESSION['colorfondo'] = $a_color;
  $_SESSION['tipoletra'] = $a_letra;
}
