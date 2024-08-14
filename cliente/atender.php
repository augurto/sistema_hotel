<?php
$id = $_GET['id']; 
$id = htmlspecialchars($id);



// Incluir el archivo de conexión
include('../conexion/conexion.php');
include '../parts/body_start.php';
include '../parts/nav.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <form>
            <input type="text" class="form-control" id="id_form" value="<?php echo $id; ?>">
            <input type="text" class="form-control" id="id_user" value="9">

                
                
                <div class="mb-3">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="documento">
                </div>
                <div class="mb-3">
                    <label for="datos" class="form-label">Datos</label>
                    <input type="text" class="form-control" id="datos">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="datos" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="telefono">
                </div>
                <div class="mb-3">
                    <label for="fuente" class="form-label">Fuente :  <span class="badge text-bg-danger">Google ADS</span></label>
                   
                </div>
                
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado">
                        <option value="prospecto">Prospecto</option>
                        <option value="spam">Spam</option>
                        <option value="noGestionable">No Gestionable</option>
                        <option value="cotizar">Cotizar</option>
                        <option value="venta">Venta</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentario</label>
                    <textarea class="form-control" id="comentario" rows="3"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
        <div class="col-12 col-md-4"><i class="fas fa-clock"></i>
        </div>
    </div>
</div>

<?php
include '../parts/body_end.php';
?>