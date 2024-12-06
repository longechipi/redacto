<form id="ven_ju">
    <div class="text-center mt-3">
        <hr>
            <h5 class="mb-3">DATOS DEL VENDEDOR</h5>
        <hr>
    </div>
<input type="text" name="num_doc" id="num_doc" value="<?php echo $id_doc; ?>" hidden />
<input type="text" name="id_user" id="id_user" value="<?php echo $id_user; ?>" hidden />
<input type="text" name="id_jur" id="id_jur" value="<?php echo $row['id_jur']; ?>" hidden />
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre de la Empresa</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_emp" id="nom_emp" value="<?php echo $row['nom_empresa']; ?>" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="rif" id="rif" value="<?php echo $row['rif']; ?>" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fecha de Registro</label> <span class="text-danger">(*)</span>
                        <input type="date" class="form-control" name="fec_reg" id="fec_reg" value="<?php echo $row['fec_registro']; ?>" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre Registro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_reg" id="nom_reg" value="<?php echo $row['nom_registro']; ?>" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tomo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="tomo" id="tomo" value="<?php echo $row['tomo']; ?>" required/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nro</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nro" id="nro" value="<?php echo $row['nro']; ?>" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Protocolo</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="protocolo" id="protocolo" value="<?php echo $row['protocolo']; ?>" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Expediente</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="exp" id="exp" value="<?php echo $row['expediente']; ?>" required/>
                    </div>
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