<?php
// Recibir datos del webhook
$data = file_get_contents("php://input");

// Convertir los datos en un array asociativo
parse_str($data, $datosArray);

// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Obtener la fecha y hora actual de Perú
$fecha_actual = new DateTime('now', new DateTimeZone('America/Lima'));
$fecha_actual_str = $fecha_actual->format('Y-m-d H:i:s');

// Preparar la consulta SQL utilizando declaraciones preparadas
$sql = "INSERT INTO formulario (Datos, Email, Telefono, Mensaje, form_id, form_name, ip, url_web, fecha_actual)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Vincular los parámetros y ejecutar la declaración
    $stmt->bind_param("sssssssss",
        $datosArray['Datos'],
        $datosArray['Email'],
        $datosArray['Telefono'],
        $datosArray['Mensaje'],
        $datosArray['form_id'],
        $datosArray['form_name'],
        $datosArray['ip'],
        $datosArray['url'],
        $fecha_actual_str
    );

    if ($stmt->execute()) {
        echo "Datos insertados correctamente en la base de datos";

        // Guardar los datos en un archivo de texto
        file_put_contents("webhook_data.txt", print_r($datosArray, true));
        echo "Datos guardados en el archivo webhook_data.txt";
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
