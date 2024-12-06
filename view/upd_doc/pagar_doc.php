<form id="pago">
    <div class="text-center mt-4">
        <hr>
        <h5 class="mb-3">PAGO DEL DOCUMENTO</h5>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h5 class="text-center">Atención</h5>
            <p class="text-center">Una vez que canceles este documento, no podrás realizar más modificaciones. Te recomendamos revisar cuidadosamente toda la información antes de confirmar la cancelación.</p>
            <div class="custom-control custom-checkbox mb-5">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">
                    <a href="#" class="text-primary" data-toggle="modal" data-target="#terminos">Sí, Acepto los Terminos y Condiciones</a> 
                </label>
            </div>
            <?php include('modal/terminos.php'); ?>
        </div>
        <div class="col-md-3">
        <h5 class="text-center mb-3">Datos del Pago</h5>
            <p ><strong>Banco: </strong> Nombre del Banco</p>
            <p><strong>Nro Cuenta: </strong> Numero de Cuenta</p>
            <p><strong>Tipo Cuenta: </strong> Ahorro / Corriente</p>
            <p><strong>Teléfono: </strong> Numero de Teléfono</p>
            <p><strong>Correo: </strong> Correo asociado</p>
        </div>
        <div class="col-md-3">
        <h5 class="text-center mb-3">Datos del Pago</h5>
            <p><strong>Banco: </strong> Nombre del Banco</p>
            <p><strong>Nro Cuenta: </strong> Numero de Cuenta</p>
            <p><strong>Tipo Cuenta: </strong> Ahorro / Corriente</p>
            <p><strong>Teléfono: </strong> Numero de Teléfono</p>
            <p><strong>Correo: </strong> Correo asociado</p>
        </div>

        <div class="col-md-12">
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;REPORTAR PAGO</button>
            <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
        </div>
    </div>

    </div>
</form>