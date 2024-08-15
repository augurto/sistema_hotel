<?php
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>

<div class="container mt-5">
        <h2>Registrar Habitación</h2>
        <form action="../include/guardar/registrar_habitacion.php" method="post" enctype="multipart/form-data">
            <!-- Número de Habitación -->
            <div class="form-group mb-3">
                <label for="roomNumber">Número de Habitación</label>
                <div class="input-group">
                    <span class="input-group-text">Número</span>
                    <input type="text" class="form-control" id="roomNumber" name="roomNumber" placeholder="Ingrese el número de habitación" required>
                </div>
            </div>

            <!-- Piso -->
            <div class="form-group mb-3">
                <label for="floor">Piso</label>
                <div class="input-group">
                    <span class="input-group-text">Piso</span>
                    <select class="form-control" id="floor" name="floor" required>
                        <option value="" disabled selected>Seleccione</option>
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <!-- Tipo de Cama -->
            <div class="form-group mb-3">
                <label for="bedType">Tipo de Cama</label>
                <div class="input-group">
                    <span class="input-group-text">Tipo de Cama</span>
                    <select class="form-control" id="bedType" name="bedType" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="simple">Cama Simple</option>
                        <option value="doble">Cama Doble</option>
                        <option value="matrimonial">Cama Matrimonial</option>
                    </select>
                </div>
            </div>

            <!-- Baño -->
            <div class="form-group mb-3">
                <label for="bathroom">Baño</label>
                <div class="input-group">
                    <span class="input-group-text">Baño</span>
                    <select class="form-control" id="bathroom" name="bathroom" required>
                        <option value="" disabled selected>Seleccione</option>
                        <option value="compartido">Compartido</option>
                        <option value="incluido">Incluido</option>
                    </select>
                </div>
            </div>

            <!-- Precio -->
            <div class="form-group mb-3">
                <label for="price">Precio</label>
                <div class="input-group">
                    <span class="input-group-text">S/</span>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Ingrese el precio" step="0.01" required>
                </div>
            </div>

            <!-- Imagen -->
            <div class="form-group mb-3">
                <label for="roomImage">Imagen de la Habitación</label>
                <input class="form-control" type="file" id="roomImage" name="roomImage" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Habitación</button>
        </form>
    </div>


<?php
include ('../parts/body_end.php');
?>