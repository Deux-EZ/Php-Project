<?php
$dbhost = "localhost";
$dbport = "3307"; // Reemplaza con el puerto correcto si no es 3306
$dbuser = "root";
$dbpass = "";
$dbname = "bdtest";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname, $dbport);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
