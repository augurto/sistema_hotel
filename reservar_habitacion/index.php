<?php
// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Obtener la lista de clientes
$sql_clientes = "SELECT id, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM clientes";
$result_clientes = $conn->query($sql_clientes);

// Obtener la lista de habitaciones
$sql_habitaciones = "SELECT id, numero_habitacion FROM habitaciones WHERE estado_habitacion = 0";
$result_habitaciones = $conn->query($sql_habitaciones);
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>

<div class="container mt-5">
    <h2>Reservar Habitación</h2>

    <!-- Formulario de reserva -->
    <form action="../include/guardar/registrar_reservacion.php" method="post">
        <div class="form-group">
            <label for="cliente">Cliente</label>
            <select class="form-control" id="cliente" name="id_cliente" required>
                <option value="">Seleccione un cliente</option>
                <?php while ($row = $result_clientes->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre_completo']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="habitacion">Habitación</label>
            <select class="form-control" id="habitacion" name="id_habitacion" required>
                <option value="">Seleccione una habitación</option>
                <?php while ($row = $result_habitaciones->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['numero_habitacion']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_ingreso">Fecha de Ingreso</label>
            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
        </div>

        <div class="form-group">
            <label for="fecha_egreso">Fecha de Egreso</label>
            <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso" required>
        </div>

        <div class="form-group">
            <label for="cantidad_personas">Cantidad de Personas</label>
            <input type="number" class="form-control" id="cantidad_personas" name="cantidad_personas" value="1" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Reserva</button>
    </form>

    <!-- Cerrar conexión -->
    <?php
    $result_clientes->free();
    $result_habitaciones->free();
    $conn->close();
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
include('../parts/body_end.php');
?>