<?php
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>

<div class="container mt-5">
        <h2>Crear Habitación</h2>
        <form action="procesar_habitacion.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="roomNumber">Número de Habitación</label>
                <input type="text" class="form-control" id="roomNumber" name="roomNumber" placeholder="Ingrese el número de habitación" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="floor">Piso</label>
                <select class="form-control" id="floor" name="floor" required>
                    <option value="" disabled selected>Seleccione el piso</option>
                    <option value="1">Piso 1</option>
                    <option value="2">Piso 2</option>
                    <option value="3">Piso 3</option>
                    <option value="4">Piso 4</option>
                    <option value="5">Piso 5</option>
                    <option value="6">Piso 6</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="bedType">Tipo de Cama</label>
                <select class="form-control" id="bedType" name="bedType" required>
                    <option value="" disabled selected>Seleccione el tipo de cama</option>
                    <option value="simple">Cama Simple</option>
                    <option value="doble">Cama Doble</option>
                    <option value="matrimonial">Cama Matrimonial</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="bathType">Tipo de Baño</label>
                <select class="form-control" id="bathType" name="bathType" required>
                    <option value="" disabled selected>Seleccione el tipo de baño</option>
                    <option value="compartido">Baño Compartido</option>
                    <option value="incluido">Baño Incluido</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="price">Precio</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Ingrese el precio" required>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Subir Imagen</label>
                <input class="form-control" type="file" id="formFile" name="image" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Habitación</button>
        </form>
    </div>
<?php
include ('../parts/body_end.php');
?>