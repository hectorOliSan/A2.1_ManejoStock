<?php
date_default_timezone_set('Atlantic/Canary');

if (!isset($_POST['usuario']) || !isset($_POST['clave'])) {
  noAutorizado('sesion');
}

$autorizado = obtenerUsuario($_POST['usuario'], hash('sha256', $_POST['clave']));
if ($autorizado == null) {
  setcookie(
    'num_accesos_in',
    isset($_COOKIE['num_accesos_in']) ? ++$_COOKIE['num_accesos_in'] : 1,
    time() + 2629800
  );

  if (isset($_COOKIE["usu_incorrecto"])) {
    $num = sizeof($_COOKIE['usu_incorrecto']);
    setcookie(
      "usu_incorrecto[$num]",
      $_POST['usuario'] . " - " . hash('sha256', $_POST['clave']),
      time() + 2629800
    );
  } else {
    setcookie(
      "usu_incorrecto[0]",
      $_POST['usuario'] . " - " . hash('sha256', $_POST['clave']),
      time() + 2629800
    );
  }

  noAutorizado('user_pass');
}

$_SESSION["usuario"] = $_POST['usuario'];
$_SESSION["clave"] = $_POST['clave'];
$_SESSION["nombrecompleto"] = $autorizado[0]["nombrecompleto"];
$_SESSION["correo"] = $autorizado[0]["correo"];
$_SESSION["colorfondo"] = $autorizado[0]["colorfondo"];
$_SESSION["tipoletra"] = $autorizado[0]["tipoletra"];

if (isset($_COOKIE["inicio_sesion"])) {
  $num = sizeof($_COOKIE['inicio_sesion']);
  setcookie("inicio_sesion[$num]", date("d/m/Y H:i:s", time()), time() + 2629800);
} else {
  setcookie("inicio_sesion[0]", date("d/m/Y H:i:s", time()), time() + 2629800);
}
