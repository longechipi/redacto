<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();

@$id_form = $_POST['id_form'];
validar_post_char($id_form, 'inicio');

?>
<body>
<?php include('../layouts/navbar.php');?>
<?php include('../layouts/options.php');?>
<?php include('../layouts/menu.php'); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Datos del Documento: <?php echo $id_form; ?></h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="documentos">Documentos Guardados</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagar Documento</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
                <div class="text-center">
                    <div class="alert alert-danger" role="alert">
                    <i class="icon-copy dw dw-idea"></i> <br> <h5 class="mb-3">¡ATENCIÓN!</h5>
                    &nbsp;Recuerde revisar los datos que esten escritos correctamente antes de pagar el documento, una vez cancelado el documento no podrá modificarlo 
                    </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                   <div class="tab">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link text-blue active" data-toggle="tab" href="#vendedor" role="tab" aria-selected="false">DATOS DEL VENDEDOR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue" data-toggle="tab" href="#comprador" role="tab" aria-selected="false">DATOS DEL COMPRADOR</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue " data-toggle="tab" href="#vehiculo" role="tab" aria-selected="true">DATOS DEL VEHÍCULO</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-blue " data-toggle="tab" href="#contact5" role="tab" aria-selected="true">IMPORTE DE VENTA</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="vendedor" role="tabpanel">
                                <div class="pd-20">
                                    <form id="ven">
                                        <input type="text" name="num_doc" id="num_doc" class="form-control" value="<?php echo $id_form; ?>" hidden readonly />
                                        <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $id_user; ?>" hidden readonly />
                                        <?php
                                        //-------- Datos del Vendedor --------//
                                        $a="SELECT * FROM per_natural WHERE num_doc = '$id_form' AND tip_per = 2"; 
                                        $ares= $conn->query($a);
                                        $row = $ares->fetch_assoc();
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tipo de Persona </label> <span class="text-danger">(*)</span>
                                                    <select name="tip_per" id="tip_per" class="form-control required" required>
                                                        <option value="" selected disabled>SELECCIONAR</option>
                                                        <option value="N" selected>Natural</option>
                                                        <option value="J">Jurídico</option>
                                                        <option value="S">Sucesión</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

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
                                                    <label>Segundo Apellido </label> <span class="text-danger">(*)</span>
                                                    <input type="text" class="form-control" name="apellido2" id="apellido2" onkeypress="return letras(this, event);" value="<?php echo $row['apellido2']?>" required />
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

                                            <?php if($row['civil'] == 'C'){?>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nombre Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="nom_conyuge" id="nom_conyuge" onkeypress="return letras(this, event);" value="<?php echo $row['nom_conyuge']; ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Apellido Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="ape_conyuge" id="ape_conyuge" onkeypress="return letras(this, event);" value="<?php echo $row['apel_conyuge']; ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Cédula Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="ced_conyuge" id="ced_conyuge" onkeypress="return numeros(this, event);" value="<?php echo $row['cedula_conyuge']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php  }else{ ?>
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
                                                <?php  } ?> 

                                        </div>
                                            

                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;ACTUALIZAR</button>
                                                <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="comprador" role="tabpanel">
                                <div class="pd-20">
                                    <form id="compra">
                                        <input type="text" name="com_num_doc" id="com_num_doc" class="form-control" value="<?php echo $id_form; ?>" hidden readonly />
                                        <input type="text" name="com_id_user" id="com_id_user" class="form-control" value="<?php echo $id_user; ?>" hidden readonly />
                                        <?php
                                        //-------- Datos del Comprador --------//
                                        $b="SELECT * FROM per_natural WHERE num_doc = '$id_form' AND tip_per = 1"; 
                                        $bres= $conn->query($b);
                                        $brow = $bres->fetch_assoc();
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Tipo de Persona </label> <span class="text-danger">(*)</span>
                                                    <select name="com_tip_per" id="com_tip_per" class="form-control required" required>
                                                        <option value="" selected disabled>SELECCIONAR</option>
                                                        <option value="N" selected>Natural</option>
                                                        <option value="J">Jurídico</option>
                                                        <option value="S">Sucesión</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Primer Nombre </label> <span class="text-danger">(*)</span>
                                                    <input type="text" class="form-control" name="com_nombre1" id="com_nombre1" onkeypress="return letras(this, event);" value="<?php echo $brow['nombre1']?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Segundo Nombre </label>
                                                    <input type="text" class="form-control" name="com_nombre2" onkeypress="return letras(this, event);" value="<?php echo $brow['nombre2']?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Primer Apellido </label> <span class="text-danger">(*)</span>
                                                    <input type="text" class="form-control" name="com_apellido1" id="com_apellido1" onkeypress="return letras(this, event);" value="<?php echo $brow['apellido1']?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Segundo Apellido </label> <span class="text-danger">(*)</span>
                                                    <input type="text" class="form-control" name="com_apellido2" id="com_apellido2" onkeypress="return letras(this, event);" value="<?php echo $brow['apellido2']?>" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nacionalidad</label> <span class="text-danger">(*)</span>
                                                    <select name="com_nac" id="com_nac" class="form-control" required>
                                                        <?php 
                                                            $bopciones = ['V', 'E'];
                                                            $bvalor = $brow['nac'];
                                                            foreach ($bopciones as $bopcion) {
                                                                if ($bvalor != $bopcion) {
                                                                    echo '<option value="' . $bopcion . '">' . $bopcion . '</option>';
                                                                }
                                                            }
                                                            echo '<option value="' . $bvalor . '" selected>' . $bvalor . '</option>';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Nro de Cédula</label> <span class="text-danger">(*)</span>
                                                    <input type="text" class="form-control" name="com_cedula" id="com_cedula" onkeypress="return numeros(this, event);" value="<?php echo $brow['cedula']?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Estado Civil</label> <span class="text-danger">(*)</span>
                                                    <select name="com_edo_civil" id="com_edo_civil" class="form-control" required>
                                                       <?php 
                                                            $bopciones = ['S' => 'Soltero','C' => 'Casado','V' => 'Viudo','D' => 'Divorciado'];
                                                            $bvalor = $brow['civil'];
                                                            foreach ($bopciones as $bopcion => $btexto) {
                                                                if ($bvalor != $bopcion) {
                                                                    echo '<option value="' . $bopcion . '">' . $btexto . '</option>';
                                                                }
                                                            }
                                                            echo '<option value="' . $bvalor . '" selected>' . $bopciones[$bvalor] . '</option>';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <?php if($brow['civil'] == 'C'){?>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Nombre Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="com_nom_conyuge" id="com_nom_conyuge" onkeypress="return letras(this, event);" value="<?php echo $brow['nom_conyuge']; ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Apellido Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="com_ape_conyuge" id="com_ape_conyuge" onkeypress="return letras(this, event);" value="<?php echo $brow['apel_conyuge']; ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Cédula Cónyuge</label> <span class="text-danger">(*)</span>
                                                            <input type="text" class="form-control" name="com_ced_conyuge" id="com_ced_conyuge" onkeypress="return numeros(this, event);" value="<?php echo $brow['cedula_conyuge']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php  }else{ ?>
                                                <div class="row" id="com_casado" hidden>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nombre Cónyuge</label> <span class="text-danger">(*)</span>
                                                        <input type="text" class="form-control" name="com_nom_conyuge" id="com_nom_conyuge" onkeypress="return letras(this, event);" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Apellido Cónyuge</label> <span class="text-danger">(*)</span>
                                                        <input type="text" class="form-control" name="com_ape_conyuge" id="com_ape_conyuge" onkeypress="return letras(this, event);" >
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cédula Cónyuge</label> <span class="text-danger">(*)</span>
                                                        <input type="text" class="form-control" name="com_ced_conyuge" id="com_ced_conyuge" onkeypress="return numeros(this, event);" >
                                                    </div>
                                                </div>
                                                </div>
                                                <?php  } ?> 
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary"><i class="icon-copy dw dw-floppy-disk"></i>&nbsp;ACTUALIZAR</button>
                                                <a href="javascript:history.back()" class="btn btn-outline-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-curved-arrow1"></i>&nbsp;VOLVER </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="vehiculo" role="tabpanel">
                                <div class="pd-20">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </div>
                            </div>
                        </div>
					</div>
                   </div>
                    
                </div>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
$(document).ready(function(){
    //------- CONDICIONAL PARA CONYUGE --------//
    $('#edo_civil').change(function(){
        if($('#edo_civil').val() == 'C'){
            $('#casado').removeAttr('hidden');
            $('#nom_conyuge').attr('required', true);
            $('#ape_conyuge').attr('required', true);
            $('#ced_conyuge').attr('required', true);
        }else{
            $('#casado').attr('hidden', true);
            $('#nom_conyuge').removeAttr('required');
            $('#ape_conyuge').removeAttr('required');
            $('#ced_conyuge').removeAttr('required');
        }
    });
    //----- FORM PARA EL VENDEDOR -----//
    $('#ven').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/update_vendedor.php',
            type: 'POST',
            data: $('#ven').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
    //----- FORM PARA EL COMPRADOR -----//
    $('#compra').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '../model/documento/update_comprador.php',
            type: 'POST',
            data: $('#compra').serialize(),
            success: function(data){
                const res = JSON.parse(data);
                if(res.status == 'error'){
                    swal({
                        title: 'Error al Actualizar',
                        text: res.message,
                        type: 'error',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                    return
                }else{
                    swal({
                        title: 'Actualización Exitosa',
                        text: res.message,
                        type: 'success',
                        confirmButtonColor: '#1b61c2',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        });
    });
});
</script>

</body>
</html>