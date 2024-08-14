<?php
include('conexion.php');

// Comprueba si la conexión se estableció correctamente
if ($conn) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error de conexión: " . $conn->connect_error;
}

// Cerrar la conexión
$conn->close();
?>
