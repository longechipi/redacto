<section>
    <div class="text-center">
        <div class="alert alert-primary" role="alert">
        <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
        </div>
        <h5 class="mb-3">REGISTRE LOS DATOS DEL VEHÍCULO</h5>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Registro Vehículo Nro</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="reg_veh" id="reg_veh" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Fecha Certificado</label> <span class="text-danger">(*)</span>
                <input type="date" class="form-control" name="fec_cert" id="fec_cert" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Clase</label> <span class="text-danger">(*)</span>
                <select name="clase" id="clase" class="form-control">
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="VEHICULO">Automóvil</option>
                    <option value="MOTO">Motocicleta</option>
                    <option value="CAMIONETA">Camioneta</option>
                    <option value="MINIBUSES">Minibuses</option>
                    <option value="AUTOBUSES">Autobuses</option>
                    <option value="CAMION">Camión</option>
                    <option value="GRUA">Grúa</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Modelo</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="modelo" id="modelo" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Año</label> <span class="text-danger">(*)</span>
                <input type="number" name="ano_veh" id="ano_veh" class="form-control" min="1900" max="<?php echo date('Y')?>" step="1" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Tipo</label> <span class="text-danger">(*)</span>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="Trail">Trail</option>
                    <option value="Cross">Cross</option>
                    <option value="Enduro">Enduro</option>
                    <option value="Sedan">Sedan</option>
                    <option value="Coupe">Coupe</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Color</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="color" id="color" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Placa</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="placa" id="placa" required />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group"> 
                <label>Marca</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="marca" id="marca" required />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Uso</label> <span class="text-danger">(*)</span>
                <select name="uso" class="form-control" id="uso">
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="PARTICULAR">Particular</option>
                    <option value="CARGA">Transporte de Carga</option>
                    <option value="PASAJERO">Transporte de Pasajero</option>
                    <option value="OTRO">Otro</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group"> 
                <label>Serial Carrocería</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="serial_carro" id="serial_carro" required />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" id="ser_motor_mayor"> 
                <label>Serial Motor</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="serial_motor" id="serial_motor" />
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
</section>