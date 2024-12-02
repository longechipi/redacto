<?php 
include('../layouts/header.php');
require('../conf/conex.php');
require('../utils/utils.php');
session_start();
?>

<body>
<?php include('../layouts/navbar.php');?>
<?php include('../layouts/options.php');?>
<?php include('../layouts/menu.php'); ?>
	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20">
            <div class="title">
                <h5>Generar Nuevo Documento</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nuevo Documento</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="wizard-content">
                <form class="tab-wizard wizard-circle wizard" id="form-doc">
                    <input type="text" name="id_user" id="id_user" class="form-control" value="<?php echo $id_user; ?>" hidden readonly/>
                    <h5>Datos del Vendedor</h5>
                    <section>
                        <div class="text-center">
                            <div class="alert alert-primary" role="alert">
                            <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
                            </div>
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
                                            <label>Segundo Apellido </label> <span class="text-danger">(*)</span>
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
                    <!-- Step 2 -->
                    <h5>Datos del Comprador</h5>
                    <section>
                        <div class="text-center">
                            <div class="alert alert-primary" role="alert">
                            <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
                            </div>
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
                                            <label>Segundo Apellido </label> <span class="text-danger">(*)</span>
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
                                        <input type="text" class="form-control" name="ced_conyuge" id="com_ced_conyuge" onkeypress="return numeros(this, event);" required>
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
                    <!-- Step 3 -->
                    <h5>Datos del Vehículo</h5>
                    <section>
                        <div class="text-center">
                            <div class="alert alert-primary" role="alert">
                            <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
                            </div>
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
                                        <option value="V">Vehículo</option>
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
                                    <input type="text" class="form-control" name="tipo" id="tipo" required />
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
                                    <input type="text" class="form-control" name="uso" id="uso" required />
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
                    </section>
                    <h5>Importe de la Venta</h5>
                    <section>
                        <div class="text-center">
                            <div class="alert alert-primary" role="alert">
                            <i class="icon-copy dw dw-idea"></i>&nbsp;Recuerde revisar que los datos que esten escritos correctamente 
                            </div>
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
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="" selected disabled>SELECCIONAR</option>
                                        <option value="AM">AMAZONAS</option>
                                        <option value="AN">ANZOÁTEGUI</option>
                                        <option value="AP">APURE</option>
                                        <option value="AR">ARAGUA</option>
                                        <option value="BA">BARINAS</option>
                                        <option value="BO">BOLÍVAR</option>
                                        <option value="CA">CARABOBO</option>
                                        <option value="CO">COJEDES</option>
                                        <option value="DA">DELTA AMACURO</option>
                                        <option value="DC">DISTRITO CAPITAL</option>
                                        <option value="FA">FALCÓN</option>
                                        <option value="GU">GUÁRICO</option>
                                        <option value="LA">LARA</option>
                                        <option value="ME">MÉRIDA</option>
                                        <option value="MI">MIRANDA</option>
                                        <option value="MO">MONAGAS</option>
                                        <option value="NE">NUEVA ESPARTA</option>
                                        <option value="PO">PORTUGUESA</option>
                                        <option value="SU">SU</option>
                                        <option value="TA">TÁCHIRA</option>
                                        <option value="TR">TRUJILLO</option>
                                        <option value="LG">LA GUAIRA</option>
                                        <option value="YA">YARACUY</option>
                                        <option value="ZU">ZULIA</option>
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
                    </section>
                </form>
            </div>
        </div>
        <?php include('../layouts/footer.php');?>
        <script src="../src/plugins/jquery-steps/jquery.steps.js"></script>
        <script>
            $("#form-doc").steps({
                headerTag: "h5",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Guardar"
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    $('.steps .current').prevAll().addClass('disabled');
                },
                onFinishing: function (event, currentIndex){
                    $.ajax({
                        url: '../model/documento/new_doc.php',
                        type: 'POST',
                        data: $('#form-doc').serialize(),
                        success: function(data){
                            console.log(data)
                            // const res = JSON.parse(data);
                            // if(res.status == 'error'){
                            //     swal({
                            //         title: 'Error al Actualizar',
                            //         text: res.message,
                            //         type: 'error',
                            //         confirmButtonColor: '#1b61c2',
                            //         confirmButtonText: 'Aceptar'
                            //     })
                            //     return
                            //     document.getElementById('banco').reset();
                            // }else{
                            //     swal({
                            //         title: 'Actualización Exitosa',
                            //         text: res.message,
                            //         type: 'success',
                            //         confirmButtonColor: '#1b61c2',
                            //         confirmButtonText: 'Aceptar'
                            //     }).then(function() {
                            //         window.location.href = 'banco';
                            //     });
                            //     document.getElementById('banco').reset();
                            // }
                        }
                    });
                },
                onStepChanging: function (event, currentIndex, newIndex){
                    //--------- Validacion para el Primer Step ------------//
                    if(currentIndex == 0){ 
                        //----- Validacion para Natural ------//
                        if($('#tip_per').val() == 'N'){
                            if(($('#tip_per').val() == '') || ($('#nombre1').val() == '') || ($('#apellido1').val() == '') || ($('#apellido2').val() == '') || ($('#nac').val() == '') || ($('#cedula').val() == '') || ($('#edo_civil').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }else{
                                if($('#edo_civil').val() == 'C'){
                                    if(($('#nom_conyuge').val() == '') || ($('#ape_conyuge').val() == '') || ($('#ced_conyuge').val() == '')){
                                        swal({
                                            title: 'Error',
                                            text: 'Complete los Campos Requeridos',
                                            type: 'error',
                                            confirmButtonColor: '#1b61c2',
                                            confirmButtonText: 'Aceptar'
                                        })
                                        return false;
                                    }
                                }
                            }
                        }
                        //----- Validacion para Juridico ------//
                        if($('#tip_per').val() == 'J'){
                            if(($('#tip_per').val() == '') || ($('#nom_emp').val() == '') || ($('#rif').val() == '') || ($('#fec_reg').val() == '') || ($('#nom_reg').val() == '') || ($('#tomo').val() == '') || ($('#nro').val() == '') || ($('#protocolo').val() == '') || ($('#exp').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                        //----- Validacion para Sucesion ------//
                        if($('#tip_per').val() == 'S'){
                            if(($('#tip_per').val() == '') || ($('#nom_suc').val() == '') || ($('#rif_su').val() == '') || ($('#cer_sol').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                    } 
                    //--------- Validacion para el Segundo Step ----------//
                    if(currentIndex == 1){ 
                        //----- Validacion para Natural ------//
                        if($('#com_tip_per').val() == 'N'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nombre1').val() == '') || ($('#com_apellido1').val() == '') || ($('#com_apellido2').val() == '') || ($('#com_nac').val() == '') || ($('#com_cedula').val() == '') || ($('#com_edo_civil').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }else{
                                if($('#com_edo_civil').val() == 'C'){
                                    if(($('#com_nom_conyuge').val() == '') || ($('#com_ape_conyuge').val() == '') || ($('#com_ced_conyuge').val() == '')){
                                        swal({
                                            title: 'Error',
                                            text: 'Complete los Campos Requeridos',
                                            type: 'error',
                                            confirmButtonColor: '#1b61c2',
                                            confirmButtonText: 'Aceptar'
                                        })
                                        return false;
                                    }
                                }
                            }
                        }
                        //----- Validacion para Juridico ------//
                        if($('#com_tip_per').val() == 'J'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nom_emp').val() == '') || ($('#com_rif').val() == '') || ($('#com_fec_reg').val() == '') || ($('#com_nom_reg').val() == '') || ($('#com_tomo').val() == '') || ($('#com_nro').val() == '') || ($('#com_protocolo').val() == '') || ($('#com_exp').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                        //----- Validacion para Sucesion ------//
                        if($('#com_tip_per').val() == 'S'){
                            if(($('#com_tip_per').val() == '') || ($('#com_nom_suc').val() == '') || ($('#com_rif_su').val() == '') || ($('#com_cer_sol').val() == '')){
                                swal({
                                    title: 'Error',
                                    text: 'Complete los Campos Requeridos',
                                    type: 'error',
                                    confirmButtonColor: '#1b61c2',
                                    confirmButtonText: 'Aceptar'
                                })
                                return false;
                            }
                            
                        }
                    }
                    //--------- Validacion para el Tercer Step ----------//
                    if(currentIndex == 2){
                        if(($('#reg_veh').val() == '') || ($('#fec_cert').val() == '') || ($('#clase').val() == '') || ($('#modelo').val() == '') || ($('#ano_veh').val() == '') || ($('#tipo').val() == '') || ($('#color').val() == '') || ($('#placa').val() == '') || ($('#marca').val() == '') || ($('#uso').val() == '') || ($('#serial_carro').val() == '')){
                            swal({
                                title: 'Error',
                                text: 'Complete los Campos Requeridos',
                                type: 'error',
                                confirmButtonColor: '#1b61c2',
                                confirmButtonText: 'Aceptar'
                            })
                            return false;

                        }
                        // else{
                        //     $('#clase').change(function(){
                        //         if($('#clase').val() == 'V'){
                        //             $('#ano_veh').on('blur', function() {
                        //                 if($('#ano_veh').val() <= 2000){
                        //                    if(($('#ser_motor').val() == '')){
                        //                         swal({
                        //                             title: 'Error',
                        //                             text: 'Complete los Campos Requeridos',
                        //                             type: 'error',
                        //                             confirmButtonColor: '#1b61c2',
                        //                             confirmButtonText: 'Aceptar'
                        //                         })
                        //                         return false;
                        //                    }
                        //                 }else{
                        //                    if(($('#serial_motor').val() == '')){
                        //                         swal({
                        //                             title: 'Error',
                        //                             text: 'Complete los Campos Requeridos',
                        //                             type: 'error',
                        //                             confirmButtonColor: '#1b61c2',
                        //                             confirmButtonText: 'Aceptar'
                        //                         })
                        //                         return false;
                        //                    }
                        //                 }
                        //             })
                        //         }
                        //     })
                        // }
                    }
                    return true;
                },
            });
            //-------- CONDICIONAL PARA VENDEDOR ----------//
            $('#tip_per').change(function(){
                //----- Habilito Formulario de Persona Natural ------//
                if($('#tip_per').val() == 'N'){
                    $('#natural').removeAttr('hidden');
                    $('#juridico').attr('hidden', true);
                    $('#sucesion').attr('hidden', true);

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

                }
                //----- Habilito Formulario de Persona Juridica ------//
                if($('#tip_per').val() == 'J'){
                    $('#juridico').removeAttr('hidden');
                    $('#natural').attr('hidden', true);
                    $('#sucesion').attr('hidden', true);

                    //---- Validacion para la Fecha ----//
                    $('#fec_reg').on('blur', function() {
                        validarFecha(this);
                    })

                }
                //----- Habilito Formulario de Sucesion ------//
                if($('#tip_per').val() == 'S'){
                    $('#sucesion').removeAttr('hidden');
                    $('#natural').attr('hidden', true);
                    $('#juridico').attr('hidden', true);
                }
            })

            //-------- CONDICIONAL PARA COMPRADOR ----------//
             $('#com_tip_per').change(function(){
                //----- Habilito Formulario de Comprador Natural ------//
                if($('#com_tip_per').val() == 'N'){
                    $('#com_natural').removeAttr('hidden');
                    $('#com_juridico').attr('hidden', true);
                    $('#com_sucesion').attr('hidden', true);

                    //------- CONDICIONAL PARA CONYUGE --------//
                    $('#com_edo_civil').change(function(){
                        if($('#com_edo_civil').val() == 'C'){
                            $('#com_casado').removeAttr('hidden');
                            $('#com_nom_conyuge').attr('required', true);
                            $('#com_ape_conyuge').attr('required', true);
                            $('#com_ced_conyuge').attr('required', true);
                        }else{
                            $('#com_casado').attr('hidden', true);
                            $('#com_nom_conyuge').removeAttr('required');
                            $('#com_ape_conyuge').removeAttr('required');
                            $('#com_ced_conyuge').removeAttr('required');
                        }
                    });

                }
                //----- Habilito Formulario de Comprador Juridica ------//
                if($('#com_tip_per').val() == 'J'){
                    $('#com_juridico').removeAttr('hidden');
                    $('#com_natural').attr('hidden', true);
                    $('#com_sucesion').attr('hidden', true);

                    //---- Validacion para la Fecha ----//
                    $('#com_fec_reg').on('blur', function() {
                        validarFecha(this);
                    })

                }
                //----- Habilito Formulario Comprador de Sucesion ------//
                if($('#com_tip_per').val() == 'S'){
                    $('#com_sucesion').removeAttr('hidden');
                    $('#com_natural').attr('hidden', true);
                    $('#com_juridico').attr('hidden', true);
                }
            })

            //-------- CONDICIONAL PARA VEHICULO ----------//
             $('#clase').change(function(){
                if($('#clase').val() == 'V'){
                    $('#ano_veh').on('blur', function() {
                        if($('#ano_veh').val() <= 2000){
                           $('#ser_motor_menor').removeAttr('hidden');
                           $('#ser_motor_mayor').attr('hidden', true);
                        }else{
                            $('#ser_motor_mayor').removeAttr('hidden');
                            $('#ser_motor_menor').attr('hidden', true);
                        }
                    })
                }
            })
            //---- Validacion para la Fecha ----//
            $('#fec_cert').on('blur', function() {
                validarFecha(this);
            })

            //-------- CALCULO PARA DOLARES ----------//
            function calculateBolivares() {
                var divisa = parseFloat($('#divisa').val());
                var tasa = parseFloat($('#tasa').val());
                    if (!isNaN(divisa) && !isNaN(tasa)) {
                        var bs = divisa * tasa;
                        $('#bs').val(bs.toFixed(2));
                    }else {
                        $('#bs').val('');
                    }
            }
            $('#divisa, #tasa').on('input', calculateBolivares);
            calculateBolivares();
        </script>
</body>
</html>