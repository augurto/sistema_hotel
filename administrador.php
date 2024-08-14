<?php
// Incluir el archivo de conexión
include('./conexion/conexion.php');

// Realizar una consulta SQL para obtener los datos de la tabla formulario
$sql = "SELECT * FROM formulario";
$result = $conn->query($sql);
include './parts/body_start.php';
include './parts/datatable.php';
include './parts/nav.php';
?>

<div class="container">
    <div class="table-responsive-xxl">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Datos</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fecha Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inicializar el contador
                $contador = 1;

                // Mostrar los datos en la tabla
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $contador . "</td>";
                    echo "<td>" . $row['Datos'] . "</td>";
                    echo "<td>" . $row['Email'] . "</td>";
                    echo "<td>" . $row['Telefono'] . "</td>";
                    echo "<td>" . $row['fecha_actual'] . "</td>";
                    echo "</tr>";

                    // Incrementar el contador
                    $contador++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<?php
include './parts/body_end.php';
?>