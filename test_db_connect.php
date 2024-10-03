<?php
// Incluir el archivo de conexión
include 'db_connect.php';

// Verificar la conexión
if ($conecta) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error de conexión: " . mysqli_connect_error();
}
?>
