<?php
include('../parts/body_start.php');
// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Variable para almacenar mensajes de error
$mensaje_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificar si se envió el formulario
  if (isset($_POST["submit"])) {
    // Obtener los datos del formulario
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    // Consultar la base de datos para verificar la autenticación
    $sql = "SELECT id, tipo_usuario FROM usuarios WHERE correo = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Autenticación exitosa
      $row = $result->fetch_assoc();
      $tipo_usuario = $row["tipo_usuario"];

      // Redirigir según el tipo de usuario
      if ($tipo_usuario == 0) {
        header("Location: ../vendedor.php");
      } elseif ($tipo_usuario == 1) {
        header("Location: ../administrador.php");
      } else {
        // Tipo de usuario no reconocido, manejar de acuerdo a tus necesidades
      }

      exit();
    } else {
      // Autenticación fallida
      $mensaje_error = "Correo o contraseña incorrectos. Intenta de nuevo.";
    }

    // Cerrar la consulta
    $stmt->close();
  }
}
?>

<div class="d-flex flex-column align-items-center justify-content-center vh-100">
  <!--   <img src="../assets/img/login_ad.png" class="img-thumbnail" alt="..."> -->
  <form style="border: 1px solid #dbdbdb; padding: 25px; border-radius: 12px;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Correo</label>
      <input type="email" class="form-control" id="exampleInputEmail1" name="correo" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">Nunca compartiremos tu correo electrónico con nadie más.</div>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="recuerdame">
      <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Ingresar</button>
  </form>

  <!-- Mensaje de error -->
  <?php
  if (!empty($mensaje_error)) {
    echo "<div class='alert alert-danger mt-3' role='alert'>";
    echo $mensaje_error;
    echo "</div>";
  }
  ?>
</div>
<?php
include '../parts/body_end.php';
?>