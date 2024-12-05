<section>
    <div class="text-center">
        <div class="alert alert-primary" role="alert">
        <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
        </div>
        <h5>REGISTRE LOS DATOS DEL COMPRADOR</h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Tipo de Persona </label> <span class="text-danger">(*)</span>
                <select name="com_tip_per" id="com_tip_per" class="form-control required" required>
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="N">Natural</option>
                    <option value="J">Jurídico</option>
                    <option value="S">Sucesión</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Formulario para Comprador Natural -->
    <div class="row" id="com_natural" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Primer Nombre </label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_nombre1" id="com_nombre1" onkeypress="return letras(this, event);" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Segundo Nombre </label>
                        <input type="text" class="form-control" name="com_nombre2" onkeypress="return letras(this, event);" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Primer Apellido </label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_apellido1" id="com_apellido1" onkeypress="return letras(this, event);" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Segundo Apellido </label> 
                        <input type="text" class="form-control" name="com_apellido2" id="com_apellido2" onkeypress="return letras(this, event);" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nacionalidad</label> <span class="text-danger">(*)</span>
                        <select name="com_nac" id="com_nac" class="form-control" required>
                            <option value="" selected disabled>SELECCIONAR</option>
                            <option value="V">Venezolano</option>
                            <option value="E">Extranjero</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nro de Cédula</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_cedula" id="com_cedula" onkeypress="return numeros(this, event);" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Estado Civil</label> <span class="text-danger">(*)</span>
                        <select name="com_edo_civil" id="com_edo_civil" class="form-control" required>
                            <option value="" selected disabled>SELECCIONAR</option>
                            <option value="S">Soltero</option>
                            <option value="C">Casado</option>
                            <option value="V">Viudo</option>
                            <option value="V">Divorciado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="com_casado" hidden>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nombre Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="com_nom_conyuge" id="com_nom_conyuge" onkeypress="return letras(this, event);" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Apellido Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="com_ape_conyuge" id="com_ape_conyuge" onkeypress="return letras(this, event);" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cédula Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="com_ced_conyuge" id="com_ced_conyuge" onkeypress="return numeros(this, event);" required>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Formulario para Comprador Juridicas -->
    <div class="row" id="com_juridico" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre de la Empresa</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_nom_emp" id="com_nom_emp" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_rif" id="com_rif" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha de Registro</label> <span class="text-danger">(*)</span>
                        <input type="date" class="form-control" name="com_fec_reg" id="com_fec_reg" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre Registro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_nom_reg" id="com_nom_reg" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tomo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_tomo" id="com_tomo" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_nro" id="com_nro" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Protocolo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_protocolo" id="com_protocolo" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Expediente</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_exp" id="com_exp" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulario para Comprador SUCESION -->
    <div class="row" id="com_sucesion" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nombre Sucesión</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_nom_suc" id="com_nom_suc" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_rif_su" id="com_rif_su" required/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nro Certificado de Solvencia</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="com_cer_sol" id="com_cer_sol" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>