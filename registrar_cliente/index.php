<?php
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>

<div class="container mt-5">
    <h2>Registrar Cliente</h2>
    <form action="../include/guardar/registrar_cliente.php" method="post">
        <div class="form-group mb-3">
            
            <div class="input-group">
                <span class="input-group-text">Nombres</span>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ingrese sus nombres" required>
            </div>
        </div>

        <div class="form-group mb-3">
        
            <div class="input-group">
                <span class="input-group-text">Apellidos</span>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ingrese sus apellidos" required>
            </div>
        </div>


        <div class="form-group mb-3">
            
            <div class="input-group">
                <span class="input-group-text">Tipo de Documento</span>
                <select class="form-control" id="documentType" name="documentType" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="dni">DNI</option>
                    <option value="ce">C.E.</option>
                    <option value="pasaporte">Pasaporte</option>
                </select>
                <input type="text" class="form-control" id="documentValue" name="documentValue" placeholder="Ingrese el número del documento" required>

            </div>
        </div>



        <div class="form-group mb-3">
           
            <div class="input-group">
                <span class="input-group-text">Fecha de Nacimiento</span>
                <input type="date" class="form-control" id="birthDate" name="birthDate" required>
            </div>
        </div>

        <div class="form-group mb-3">
            
            <div class="input-group">
                <span class="input-group-text">Estado Civil</span>
                <select class="form-control" id="maritalStatus" name="maritalStatus" required>
                    <option value="" disabled selected>Seleccione</option>
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="divorciado">Divorciado</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Cliente</button>
    </form>
</div>


<?php
include('../parts/body_end.php');
?>