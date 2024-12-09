<section>
    <div class="text-center">
        <div class="alert alert-primary" role="alert">
        <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
        </div>
        <h5 class="mb-3">MONTO DE LA VENTA DEL VEHÍCULO</h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-primary" role="alert">
            <i class="icon-copy dw dw-idea"></i>&nbsp;Para Mayor Comodidad Coloque el Monto de la Venta en Divisas USD, se calculará en Bolivares a Tasa BCV del día 
            </div>
            <div class="form-group"> 
                <label>Ciudad de Protocolización</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="ciudad" id="ciudad" required />
            </div>
            <div class="form-group"> 
                <label>Estado</label> <span class="text-danger">(*)</span>
                <select name="estado" id="estado" class="form-control" required>
                    <?php 
                    $a="SELECT valor, estado FROM estados ORDER BY estado ASC";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){
                        echo "<option value='".$row['valor']."'>".utf8_encode($row['estado'])."</option>";
                    }
                    ?>
                </select>
            </div>

        </div>
        <div class="col-md-6">
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg monto" name="divisa" id="divisa" placeholder="Ingrese el Monto en Divisa" required/>
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy ti-money"></i></span>
                </div>
                <script>
                    $('.monto').mask('000000000.00', {
                        reverse: true
                    });
                </script>
            </div>
            <small>Tasa BCV</small>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="tasa" id="tasa" value="<?php echo round($tasaBCV, 2)?>" readonly/>
                <div class="input-group-append custom">
                    
                </div>
            </div>
            <small>Total Bolivares</small>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="bs" id="bs" readonly/>
                <div class="input-group-append custom">
                    <span class="input-group-text">Bs</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="custom-control custom-checkbox mb-5">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1"><a href="#" class="text-primary" data-toggle="modal" data-target="#terminos">Sí, Acepto los Terminos y Condiciones</a> </label>
            </div>
        </div>
                                    
    </div>
</section>
<?php include('modal/terminos.php'); ?>