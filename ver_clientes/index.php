<?php
// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Inicializar la variable de búsqueda
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

// Preparar la consulta SQL con filtro de búsqueda
$sql = "SELECT * FROM clientes WHERE nombres LIKE ? OR apellidos LIKE ? OR valor_documento LIKE ?";
$stmt = $conn->prepare($sql);

// Agregar comodines para búsqueda
$searchTerm = "%$searchQuery%";
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>
  <div class="container mt-5">
        <h2>Clientes Registrados</h2>
        
        <form method="get" action="ver_clientes.php" class="search-input">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar por nombres, apellidos o número de documento" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Tipo de Documento</th>
                        <th>Número de Documento</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Estado Civil</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nombres']); ?></td>
                            <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipo_documento']); ?></td>
                            <td><?php echo htmlspecialchars($row['valor_documento']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
                            <td><?php echo htmlspecialchars($row['estado_civil']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-warning">No se encontraron resultados.</p>
        <?php endif; ?>

        <?php
        // Cerrar la declaración y la conexión
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