<form id="imp_venta">
    <input type="text" name="id_user" id="id_user" value="<?php echo $id_user; ?>" hidden />
    <input type="text" name="num_doc" id="num_doc" value="<?php echo $id_doc; ?>" hidden />
    <input type="text" name="id_imp" id="id_imp" value="<?php echo $row['id_imp']; ?>" hidden/>
    <div class="text-center mt-4">
    <hr>
        <h5 class="mb-3">DATOS DE LA VENTA</h5>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> 
                <label>Ciudad de Protocolización</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="ciudad" id="ciudad" value="<?php echo strtoupper($row['ciudad']); ?>" required />
            </div>
            <div class="form-group"> 
                <label>Estado</label> <span class="text-danger">(*)</span>
                <select name="estado" id="estado" class="form-control" required>
                    <?php
                        $b = $conn->query("SELECT valor, estado FROM estados ORDER BY estado ASC");
                        while ($rowb = mysqli_fetch_array($b)) {
                            if ($rowb['valor'] == $row['estado']) {
                                echo '<option value="' . $rowb['valor'] . '" selected>' . utf8_encode($rowb['estado']) . '</option>';
                            } else {
                                echo '<option value="' . $rowb['valor'] . '">' . utf8_encode($rowb['estado']) . '</option>';
                            }
                        } ?>
                </select>
            </div>

        </div>
        <div class="col-md-6">
            <small>Monto USD</small>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg montos" name="divisa" id="divisa" value="<?php echo $row['monto_usd']?>" placeholder="Ingrese el Monto en Divisa" required/>
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy ti-money"></i></span>
                </div>
                
            </div>
            <small>Tasa BCV</small>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="tasa" id="tasa" value="<?php echo round($tasaBCV, 2); ?>" readonly/>
                <div class="input-group-append custom">
                    
                </div>
            </div>
            <small>Total Bolivares</small>
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" name="bs" id="bs" value="<?php echo $row['monto_bs']?>" readonly/>
                <div class="input-group-append custom">
                    <span class="input-group-text">Bs</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;ACTUALIZAR</button>
            <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
        </div>
    </div>
</form>
