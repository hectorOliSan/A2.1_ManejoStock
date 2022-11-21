<?php

if (!isset($_POST['usuario']) || !isset($_POST['clave'])) {
  noAutorizado('sesion');
}

$autorizado = obtenerUsuario($_POST['usuario'], hash('sha256', $_POST['clave']));
if ($autorizado == null) {
  noAutorizado('user_pass');
}

$_SESSION["usuario"] = $_POST['usuario'];
$_SESSION["clave"] = $_POST['clave'];
$_SESSION["nombrecompleto"] = $autorizado[0]["nombrecompleto"];
$_SESSION["correo"] = $autorizado[0]["correo"];
$_SESSION["colorfondo"] = $autorizado[0]["colorfondo"];
$_SESSION["tipoletra"] = $autorizado[0]["tipoletra"];
