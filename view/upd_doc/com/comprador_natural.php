<form id="com">
    <div class="text-center mt-3">
    <hr>
        <h5 class="mb-3">DATOS DEL COMPRADOR</h5>
        <hr>
    </div>
    <input type="text" name="num_doc" id="num_doc" class="form-control" value="<?php echo $id_doc; ?>"  hidden />
    <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $id_user; ?>" hidden />
    <input type="text" name="id_nat" id="id_nat" class="form-control" value="<?php echo $row['id_nat']; ?>" hidden />

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Primer Nombre </label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="nombre1" id="nombre1" onkeypress="return letras(this, event);" value="<?php echo $row['nombre1']?>" required />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Segundo Nombre </label>
                <input type="text" class="form-control" name="nombre2" onkeypress="return letras(this, event);" value="<?php echo $row['nombre2']?>" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Primer Apellido </label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="apellido1" id="apellido1" onkeypress="return letras(this, event);" value="<?php echo $row['apellido1']?>" required />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Segundo Apellido </label>
                <input type="text" class="form-control" name="apellido2" id="apellido2" onkeypress="return letras(this, event);" value="<?php echo $row['apellido2']?>"  />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nacionalidad</label> <span class="text-danger">(*)</span>
                <select name="nac" id="nac" class="form-control" required>
                    <?php 
                        $opciones = ['V', 'E'];
                        $valor = $row['nac'];
                        foreach ($opciones as $opcion) {
                            if ($valor != $opcion) {
                                echo '<option value="' . $opcion . '">' . $opcion . '</option>';
                            }
                        }
                        echo '<option value="' . $valor . '" selected>' . $valor . '</option>';
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nro de Cédula</label> <span class="text-danger">(*)</span>
                <input type="text" class="form-control" name="cedula" id="cedula" onkeypress="return numeros(this, event);" value="<?php echo $row['cedula']?>" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Estado Civil</label> <span class="text-danger">(*)</span>
                <select name="edo_civil" id="edo_civil" class="form-control" required>
                    <?php 
                        $opciones = ['S' => 'Soltero','C' => 'Casado','V' => 'Viudo','D' => 'Divorciado'];
                        $valor = $row['civil'];
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
        

    <div class="col-md-12">
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;ACTUALIZAR</button>
            <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
        </div>
    </div>
</form>