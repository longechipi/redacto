<section>
    <div class="text-center">
        <div class="alert alert-primary" role="alert">
        <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
        </div>
        <h5>REGISTRE LOS DATOS DEL VENDEDOR</h5>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Tipo de Persona </label> <span class="text-danger">(*)</span>
                <select name="tip_per" id="tip_per" class="form-control required" required>
                    <option value="" selected disabled>SELECCIONAR</option>
                    <option value="N">Natural</option>
                    <option value="J">Jurídico</option>
                    <option value="S">Sucesión</option>
                </select>
            </div>
        </div>
    </div>
    <!-- Formulario para Personas Natural -->
    <div class="row" id="natural" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Primer Nombre </label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nombre1" id="nombre1" onkeypress="return letras(this, event);" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Segundo Nombre </label>
                        <input type="text" class="form-control" name="nombre2" onkeypress="return letras(this, event);" >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Primer Apellido </label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="apellido1" id="apellido1" onkeypress="return letras(this, event);" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Segundo Apellido </label>
                        <input type="text" class="form-control" name="apellido2" id="apellido2" onkeypress="return letras(this, event);" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nacionalidad</label> <span class="text-danger">(*)</span>
                        <select name="nac" id="nac" class="form-control" required>
                            <option value="" selected disabled>SELECCIONAR</option>
                            <option value="V">Venezolano</option>
                            <option value="E">Extranjero</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nro de Cédula</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="cedula" id="cedula" onkeypress="return numeros(this, event);" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Estado Civil</label> <span class="text-danger">(*)</span>
                        <select name="edo_civil" id="edo_civil" class="form-control" required>
                            <option value="" selected disabled>SELECCIONAR</option>
                            <option value="S">Soltero</option>
                            <option value="C">Casado</option>
                            <option value="V">Viudo</option>
                            <option value="V">Divorciado</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="casado" hidden>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Nombre Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="nom_conyuge" id="nom_conyuge" onkeypress="return letras(this, event);" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Apellido Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="ape_conyuge" id="ape_conyuge" onkeypress="return letras(this, event);" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>Cédula Cónyuge</label> <span class="text-danger">(*)</span>
                    <input type="text" class="form-control" name="ced_conyuge" id="ced_conyuge" onkeypress="return numeros(this, event);" required>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- Formulario para Personas Juridicas -->
    <div class="row" id="juridico" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre de la Empresa</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_emp" id="nom_emp" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="rif" id="rif" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha de Registro</label> <span class="text-danger">(*)</span>
                        <input type="date" class="form-control" name="fec_reg" id="fec_reg" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre Registro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_reg" id="nom_reg" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tomo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="tomo" id="tomo" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nro" id="nro" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Protocolo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="protocolo" id="protocolo" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Expediente</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="exp" id="exp" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Formulario para SUCESION -->
    <div class="row" id="sucesion" hidden>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nombre Sucesión</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_suc" id="nom_suc" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="rif_su" id="rif_su" required/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nro Certificado de Solvencia</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="cer_sol" id="cer_sol" required />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>