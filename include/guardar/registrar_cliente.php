<?php
// Incluir el archivo de conexión
include('../../conexion/conexion.php');

// Obtener los datos del formulario
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$documentType = $_POST['documentType'];
$documentValue = $_POST['documentValue'];
$birthDate = $_POST['birthDate'];
$maritalStatus = $_POST['maritalStatus'];

// Preparar la consulta SQL
$sql = "INSERT INTO clientes (nombres, apellidos, tipo_documento, valor_documento, fecha_nacimiento, estado_civil) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind los parámetros
    $stmt->bind_param("ssssss", $firstName, $lastName, $documentType, $documentValue, $birthDate, $maritalStatus);
    
    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Redireccionar a la URL después de guardar
        header('Location: https://estrella.adfusion.click/ver_clientes/');
        exit(); // Asegurarse de que el script se detiene después de la redirección
    } else {
        echo "Error al registrar el cliente: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
