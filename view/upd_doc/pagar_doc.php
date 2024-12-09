    <div class="text-center mt-4">
        <hr>
        <h5 class="mb-3">PAGO DEL DOCUMENTO</h5>
        <hr>
        <h5 class="text-center">Atención</h5>
            <p class="text-center">Una vez que canceles este documento, no podrás realizar más modificaciones. Te recomendamos revisar cuidadosamente toda la información antes de confirmar la cancelación.</p>
           
    </div>
    <div class="row">
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

        <div class="col-md-6 text-center">
            <h5 class="text-center mb-3">Total a Cancelar</h5>
            <?php 
            $a="SELECT * FROM monto_doc WHERE id_sta = 1 ORDER BY id DESC LIMIT 1";
            $ares= $conn->query($a);
            $row = $ares->fetch_assoc();
            $monto = $row['monto'];
            $b ="SELECT * FROM tasa ORDER BY fecha DESC LIMIT 1";
            $bres= $conn->query($b);
            $brow = $bres->fetch_assoc();
            $valor = $brow['valor'];
            $total = $monto * $valor;
            $total = number_format($total, 2, '.', '');
            ?>
            <h4><strong>Total USD: </strong>  <?php echo $row['monto']; ?> USD</h4>
            <br>
            <h4><strong>Total Bs: </strong>  <?php echo $total; ?> USD</h4>

        </div>

        <div class="col-md-12">
            <div class="text-center">
                <a href="reportar_pago" class="btn btn-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;REPORTAR PAGO</a>
                <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
            </div>
        </div>  
    </div>
