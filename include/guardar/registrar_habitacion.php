<?php
// Incluir el archivo de conexión
include('../../conexion/conexion.php');

// Obtener los datos del formulario
$roomNumber = $_POST['roomNumber'];
$floor = $_POST['floor'];
$bedType = $_POST['bedType'];
$bathroom = $_POST['bathroom'];
$price = $_POST['price'];

// Manejo de la imagen
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["roomImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["roomImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

// Verificar si el archivo ya existe
if (file_exists($targetFile)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}

// Verificar el tamaño del archivo
if ($_FILES["roomImage"]["size"] > 500000) {
    echo "Lo siento, el archivo es demasiado grande.";
    $uploadOk = 0;
}

// Limitar los formatos de archivo permitidos
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
    $uploadOk = 0;
}

// Verificar si $uploadOk es 0 por errores
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
// Si todo está bien, intentar subir el archivo
} else {
    if (move_uploaded_file($_FILES["roomImage"]["tmp_name"], $targetFile)) {
        echo "El archivo " . htmlspecialchars(basename($_FILES["roomImage"]["name"])) . " ha sido subido.";
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}

// Preparar la consulta SQL
$sql = "INSERT INTO habitaciones (numero_habitacion, piso, tipo_cama, baño, precio, imagen) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind los parámetros
    $stmt->bind_param("iissds", $roomNumber, $floor, $bedType, $bathroom, $price, $targetFile);
    
    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Redireccionar a la URL después de guardar
        header('Location: https://estrella.adfusion.click/ver_habitaciones/');
        exit(); // Asegurarse de que el script se detiene después de la redirección
    } else {
        echo "Error al registrar la habitación: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
