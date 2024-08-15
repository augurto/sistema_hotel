<?php
// Incluir el archivo de conexión
include('../../conexion/conexion.php');

// Obtener los datos del formulario
$id_cliente = $_POST['id_cliente'];
$id_habitacion = $_POST['id_habitacion'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_egreso = $_POST['fecha_egreso'];
$cantidad_personas = $_POST['cantidad_personas'];

// Obtener la fecha y hora actual en Perú
date_default_timezone_set('America/Lima');
$fecha_registro = date('Y-m-d H:i:s');

// Preparar la consulta SQL para insertar la reserva
$sql = "INSERT INTO reservaciones (id_cliente, id_habitacion, fecha_ingreso, fecha_egreso, cantidad_personas, fecha_registro) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iissis', $id_cliente, $id_habitacion, $fecha_ingreso, $fecha_egreso, $cantidad_personas, $fecha_registro);

if ($stmt->execute()) {
    // Redirigir a la página de éxito o listado de reservas
    header("Location: https://estrella.adfusion.click/ver_reservas/");
    exit();
} else {
    // Manejar el error
    echo "Error: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
