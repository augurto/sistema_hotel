<?php
// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Obtener la fecha y hora actual en Perú para la búsqueda de reservas
date_default_timezone_set('America/Lima');
$fecha_actual = date('Y-m-d');

// Obtener el término de búsqueda si existe
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta SQL para obtener las reservas
$sql = "SELECT r.id, c.nombres, c.apellidos, h.numero_habitacion, r.fecha_ingreso, r.fecha_egreso, r.cantidad_personas, r.fecha_registro
        FROM reservaciones r
        JOIN clientes c ON r.id_cliente = c.id
        JOIN habitaciones h ON r.id_habitacion = h.id
        WHERE c.nombres LIKE ? OR c.apellidos LIKE ? OR h.numero_habitacion LIKE ?
        ORDER BY r.fecha_registro DESC";

$stmt = $conn->prepare($sql);
$search_param = "%{$search_term}%";
$stmt->bind_param('sss', $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>


<div class="container mt-5">
        <h2>Lista de Reservas</h2>
        
        <!-- Formulario de búsqueda -->
        <form method="get" class="mb-4">
            <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar por nombre, apellido o número de habitación" value="<?php echo htmlspecialchars($search_term); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <!-- Tabla de reservas -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Número de Habitación</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de Egreso</th>
                    <th>Cantidad de Personas</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nombres'] . ' ' . $row['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($row['numero_habitacion']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_ingreso']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_egreso']); ?></td>
                            <td><?php echo htmlspecialchars($row['cantidad_personas']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_registro']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron reservas</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Cerrar conexión -->
        <?php
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
<?php
include('../parts/body_end.php');
?> 