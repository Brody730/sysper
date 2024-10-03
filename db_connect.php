<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Actualiza si es necesario
$dbname = 'estadiaunid'; // Cambia por el nombre de tu base de datos
$username = 'root'; // Tu usuario de MySQL
$password = 'ctpalm2113'; // Tu contraseña de MySQL

// Crear la conexión
$conecta = mysqli_connect($host, $username, $password, $dbname);

// Verificar la conexión
if (!$conecta) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
