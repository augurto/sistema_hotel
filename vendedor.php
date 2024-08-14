<?php
// Incluir el archivo de conexión
include('./conexion/conexion.php');

// Realizar una consulta SQL para obtener los datos de la tabla formulario
$sql = "SELECT * FROM formulario";
$result = $conn->query($sql);
include './parts/body_start.php';
include './parts/nav.php';
?>
<div class="container-fluid">
    <div class="table-responsive-xxl">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Estado</th>
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
                
                    // Verificar si el id_formulario existe en formulario_meta
                    $id_formulario = $row['id_formulario'];
                    $sql_meta = "SELECT meta_key, meta_value FROM formulario_meta WHERE id_formulario = $id_formulario";
                    $result_meta = $conn->query($sql_meta);
                
                    // Comprobar si hay resultados en formulario_meta
                    if ($result_meta && $result_meta->num_rows > 0) {
                        $row_meta = $result_meta->fetch_assoc();
                        $meta_key = $row_meta['meta_key'];
                        $meta_value = $row_meta['meta_value'];
                
                        // Imprimir badge según el valor de meta_key y meta_value
                        echo "<td>";
                        echo "<a href='cliente/atender.php?id=" . $id_formulario . "'>";
                
                        if ($meta_key === 'atendido' && $meta_value == 1) {
                            echo "<span class='badge rounded-pill text-bg-primary'>Atendido</span>";
                        } elseif ($meta_key === 'atendido' && $meta_value == 2) {
                            echo "<span class='badge rounded-pill text-bg-info'>Atendido Pendiente</span>";
                        } else {
                            echo "<span class='badge rounded-pill text-bg-danger'>No atendido</span>";
                        }
                
                        echo "</a>";
                        echo "</td>";
                    } else {
                        // Si no hay resultados en formulario_meta, imprimir badge por defecto
                        echo "<td>";
                        echo "<a href='cliente/atender.php?id=" . $id_formulario . "'>";
                        echo "<span class='badge rounded-pill text-bg-danger'>No atendido</span>";
                        echo "</a>";
                        echo "</td>";
                    }

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
<?php
include './parts/body_end.php';
?>