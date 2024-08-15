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

// Iniciar la transacción
$conn->begin_transaction();

try {
    // Preparar y ejecutar la consulta SQL para insertar la reserva
    $sql_reserva = "INSERT INTO reservaciones (id_cliente, id_habitacion, fecha_ingreso, fecha_egreso, cantidad_personas, fecha_registro) 
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_reserva = $conn->prepare($sql_reserva);
    $stmt_reserva->bind_param('iissis', $id_cliente, $id_habitacion, $fecha_ingreso, $fecha_egreso, $cantidad_personas, $fecha_registro);
    
    if (!$stmt_reserva->execute()) {
        throw new Exception("Error al registrar la reserva: " . $stmt_reserva->error);
    }

    // Preparar y ejecutar la consulta SQL para actualizar el estado de la habitación
    $sql_actualizar_estado = "UPDATE habitaciones SET estado_habitacion = 1 WHERE id = ?";
    $stmt_actualizar_estado = $conn->prepare($sql_actualizar_estado);
    $stmt_actualizar_estado->bind_param('i', $id_habitacion);
    
    if (!$stmt_actualizar_estado->execute()) {
        throw new Exception("Error al actualizar el estado de la habitación: " . $stmt_actualizar_estado->error);
    }

    // Confirmar la transacción
    $conn->commit();

    // Redirigir a la página de éxito o listado de reservas
    header("Location: https://estrella.adfusion.click/ver_reservas/");
    exit();
} catch (Exception $e) {
    // Anular la transacción en caso de error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Cerrar conexiones
$stmt_reserva->close();
$stmt_actualizar_estado->close();
$conn->close();
?>