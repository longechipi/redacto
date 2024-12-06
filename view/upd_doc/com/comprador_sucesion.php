<form id="com_suc">
    <div class="text-center mt-3">
    <hr>
        <h5 class="mb-3">DATOS DEL COMPRADOR</h5>
        <hr>
    </div>
    <input type="text" name="num_doc" id="num_doc" value="<?php echo $id_doc; ?>" />
    <input type="text" name="id_user" id="id_user" value="<?php echo $id_user; ?>" />
    <div class="row" id="sucesion">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nombre Sucesión</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="nom_suc" id="nom_suc" value="<?php echo $row['nom_sucesion']; ?>" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Rif</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="rif_su" id="rif_su" value="<?php $row['rif']; ?>" required/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nro Certificado de Solvencia</label> <span class="text-danger">(*)</span>
                        <input type="text" class="form-control" name="cer_sol" id="cer_sol" value="<?php $row['certi_solv']; ?>" required />
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