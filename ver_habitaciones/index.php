<?php
// Incluir el archivo de conexión
include('../conexion/conexion.php');

// Obtener el término de búsqueda si existe
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Preparar la consulta SQL con búsqueda
$sql = "SELECT * FROM habitaciones WHERE 
        numero_habitacion LIKE ? OR 
        tipo_cama LIKE ? OR 
        baño LIKE ?";

$searchTermWildcard = '%' . $searchTerm . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $searchTermWildcard, $searchTermWildcard, $searchTermWildcard);
$stmt->execute();
$result = $stmt->get_result();
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>


    <div class="container mt-5">
        <h2>Listado de Habitaciones</h2>
        
        <!-- Barra de búsqueda -->
        <form method="get" class="mb-4">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        
        <!-- Tabla de habitaciones -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Número de Habitación</th>
                    <th>Piso</th>
                    <th>Tipo de Cama</th>
                    <th>Baño</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['numero_habitacion']; ?></td>
                            <td><?php echo $row['piso']; ?></td>
                            <td><?php echo $row['tipo_cama']; ?></td>
                            <td><?php echo $row['baño']; ?></td>
                            <td><?php echo number_format($row['precio'], 2); ?></td>
                            <td>
                                <?php if ($row['imagen']): ?>
                                    <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen de la habitación" style="width: 100px;">
                                <?php else: ?>
                                    No disponible
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['fecha_registro']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No se encontraron habitaciones.</td>
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