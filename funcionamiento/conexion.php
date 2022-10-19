<?php
$user = 'usuario';
$password = 'clave';
$host = 'localhost';
$dbname = 'proyecto';
$dsn = "mysql:host=$host;dbname=$dbname";

$conexion;
try {
  $conexion = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
  echo "<div class='container py-5'>";
  echo "<h3 class='text-center'>Error conectando a la base de datos: " . $e . ".</h3>";
  echo "</div>";
  die();
}
