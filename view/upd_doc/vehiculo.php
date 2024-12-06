<form id="ven_vehi">
    <input type="text" name="id_user" id="id_user" value="<?php echo $id_user; ?>" hidden />
    <input type="text" name="num_doc" id="num_doc" value="<?php echo $id_doc; ?>" hidden />
    <input type="text" name="id_ven" id="id_ven" value="<?php echo $row['id_ven']; ?>" hidden/>
    <div class="text-center mt-4">
    <hr>
        <h5 class="mb-3">DATOS DEL VEHÍCULO</h5>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Registro Vehículo Nro</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="reg_veh" id="reg_veh" value="<?php echo $row['reg_vehiculo']?>" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Fecha Certificado</label> <span class="text-danger">(*)</span>
                <input type="date" class="form-control" name="fec_cert" id="fec_cert" value="<?php echo $row['fec_certi']?>" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Clase</label> <span class="text-danger">(*)</span>
                <select name="clase" id="clase" class="form-control">
                    <?php 
                    $opciones = ['VEHICULO' => 'Automóvil',
                                 'MOTO' => 'Motocicleta',
                                 'CAMIONETA' => 'Camioneta',
                                 'MINIBUSES' => 'Minibuses',
                                 'AUTOBUSES' => 'Autobuses',
                                 'CAMION' => 'Camión',
                                 'GRUA' => 'Grúa'];
                    $valor = $row['clase'];
                    foreach ($opciones as $opcion => $texto) {
                        if ($valor != $opcion) {
                            echo '<option value="' . $opcion . '">' . $texto . '</option>';
                        }
                    }
                    echo '<option value="' . $valor . '" selected>' . $opciones[$valor] . '</option>';
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Modelo</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="modelo" id="modelo" value="<?php echo $row['modelo']; ?>" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Año</label> <span class="text-danger">(*)</span>
                <input type="number" name="ano_veh" id="ano_veh" class="form-control" min="1900" max="<?php echo date('Y')?>" value="<?php echo $row['anio']; ?>" step="1" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Tipo</label> <span class="text-danger">(*)</span>
                <select name="tipo" id="tipo" class="form-control">
                    <?php 
                    $opciones = ['TRAIL' => 'Trail',
                                 'CROSS' => 'Cross',
                                 'ENDURO' => 'Enduro',
                                 'SEDAN' => 'Sedan',
                                 'COUPE' => 'Coupe'];
                    $valor = $row['tipo'];
                    foreach ($opciones as $opcion => $texto) {
                        if ($valor != $opcion) {
                            echo '<option value="' . $opcion . '">' . $texto . '</option>';
                        }
                    }
                    echo '<option value="' . $valor . '" selected>' . $opciones[$valor] . '</option>';
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Color</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="color" id="color" value="<?php echo $row['color']; ?>" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Placa</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="placa" id="placa" value="<?php echo $row['placa']; ?>" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Marca</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="marca" id="marca" value="<?php echo $row['marca']; ?>" required />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Uso</label> <span class="text-danger">(*)</span>
                <select name="uso" class="form-control" id="uso">
                    <?php 
                    $opciones = ['PARTICULAR' => 'Particular',
                                 'CARGA' => 'Transporte de Carga',
                                 'PASAJERO' => 'Transporte de Pasajero',
                                 'OTRO' => 'Otro'];
                    $valor = $row['uso'];
                    foreach ($opciones as $opcion => $texto) {
                        if ($valor != $opcion) {
                            echo '<option value="' . $opcion . '">' . $texto . '</option>';
                        }
                    }
                    echo '<option value="' . $valor . '" selected>' . $opciones[$valor] . '</option>';
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Serial Carrocería</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="serial_carro" id="serial_carro" value="<?php echo $row['serial_carro']; ?>" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" id="ser_motor_mayor"> 
                <label>Serial Motor</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="serial_motor" id="serial_motor" value="<?php echo $row['serial_motor']?>" />
            </div>
            <div class="form-group" id="ser_motor_menor" hidden> 
                <label>Serial Motor</label> <span class="text-danger">(*)</span>
                <select name="ser_motor" id="ser_motor" class="form-control">
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="4">4 CYL</option>
                    <option value="6">6 CYL</option>
                    <option value="8">8 CYL</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="otrouso" hidden>
        <div class="col-md-4">
            <div class="form-group">
                <label>Otro Uso</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="otro_uso" id="otro_uso" />
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