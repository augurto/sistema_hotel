<?php
include('../parts/body_start.php');
include('../parts/datatable.php');
include('../parts/nav.php');
?>

<div class="container mt-5">
    <h2>Registrar Cliente</h2>
    <form action="guardar/registrar_cliente.php" method="post">
        <div class="form-group mb-3">
            <label for="firstName">Nombres</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ingrese sus nombres" required>
        </div>

        <div class="form-group mb-3">
            <label for="lastName">Apellidos</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ingrese sus apellidos" required>
        </div>

        <div class="form-group mb-3">
            <label for="documentType">Tipo de Documento</label>
            <select class="form-control" id="documentType" name="documentType" required>
                <option value="" disabled selected>Seleccione el tipo de documento</option>
                <option value="dni">DNI</option>
                <option value="ce">C.E.</option>
                <option value="pasaporte">Pasaporte</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="birthDate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthDate" name="birthDate" required>
        </div>

        <div class="form-group mb-3">
            <label for="maritalStatus">Estado Civil</label>
            <select class="form-control" id="maritalStatus" name="maritalStatus" required>
                <option value="" disabled selected>Seleccione el estado civil</option>
                <option value="soltero">Soltero</option>
                <option value="casado">Casado</option>
                <option value="divorciado">Divorciado</option>
                <option value="viudo">Viudo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Cliente</button>
    </form>
</div>
<?php
include('../parts/body_end.php');
?>