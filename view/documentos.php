<?php 
include('../layouts/header.php');
require('../conf/conex.php');
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
                <h5>Documentos Guardados</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Documentos Guardados</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <hr>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>N° Documento</th>
                        <?php if($privilegios == 1) {
                            echo '<th>Usuario</th>';
                        } ?>
                        <th>Monto</th>
                        <th>Fecha Registro</th>
                        <th>Fecha Culminación</th>
                        <th>Estatus</th>
                        <th class="datatable-nosort">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT IV.id_user, IV.monto_usd, DT.fecha_ini, DT.fecha_fin, IV.num_doc, IV.id_sta, E.nom_sta, CONCAT(apellido, ' ', nombre) AS nom_user
                    FROM importe_venta IV
                    LEFT JOIN estatus E ON IV.id_sta = E.id_sta
                    LEFT JOIN users U ON IV.id_user = U.id_user
                    LEFT JOIN documentos_tmp DT ON IV.num_doc = DT.num_doc";
                    $condicion = "";
                    if ($privilegios == 4) {
                        $condicion = " WHERE IV.id_user = " . $id_user ." ORDER BY fecha_ini DESC";
                    }
                    $a .= $condicion;
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $row['num_doc']; ?></td>
                            <?php if($privilegios == 1) {
                                echo '<td>' . $row['nom_user'] . '</td>';
                            } ?>
                            <td><?php echo $row['monto_usd'] . ' ' .'$'; ?></td>
                            <td><?php echo $row['fecha_ini']; ?></td>
                            <td><?php echo $row['fecha_fin']; ?></td>
                            <td><?php echo $row['nom_sta']; ?></td>
                            <td>
                            <?php if($privilegios != 1){?> 
                                <a class="btn btn-primary btn-sm pago" href="#" data-id-doc=<?php echo $row['num_doc']?>><i class="icon-copy dw dw-credit-card"></i> Pagar</a>
                                <a class="btn btn-danger btn-sm eliminar" href="#" data-id-doc=<?php echo $row['num_doc']?>><i class="icon-copy dw dw-trash"></i> Eliminar</a>
                                <?php }else{?>
                                <a class="btn btn-primary ver" href="#" data-id-doc=<?php echo $row['num_doc']?>><i class="icon-copy dw dw-eye"></i> Ver</a>
                            <?php } 
                            ?>
                            </td>
                        </tr>
                        <?php } $conn->close(); ?>
                </tbody>
            </table>
        </div>
        <?php include('../layouts/footer.php');?>
<script>
$(document).ready(function(){
    $('.data-table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        order: [[0, 'desc']],

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
    });

    $(document).on('click', '.pago', function() {
        var id_doc = $(this).data('id-doc');
        var form = $('<form method="POST" action="pago_doc"></form>');
        form.append('<input type="hidden" name="id_form" value="' + id_doc + '">');
        $('body').append(form);
        form.submit();
    });

    $(document).on('click', '.ver', function() {
        var id_doc = $(this).data('id-doc');
        var form = $('<form method="POST" action="pago_doc"></form>');
        form.append('<input type="hidden" name="id_form" value="' + id_doc + '">');
        $('body').append(form);
        form.submit();
    });


    $(document).on('click', '.eliminar', function() {
        var id_doc = $(this).data('id-doc');
        swal({
            title: '¿Quieres eliminar el Documento \n '+id_doc+'',
            text: "Esta acción es irreversible y eliminará todos los datos ingresados",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Eliminar',
            cancelButtonText: 'No, Cancelar!'
        }).then((result) => {
                $.ajax({
                    url: '../model/documento/delete_doc.php',
                    type: 'POST',
                    data: { id_doc: id_doc },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if(res.success == false){
                            swal({
                                title: 'Error al Eliminar',
                                text: res.error.message,
                                type: 'error',
                                confirmButtonColor: '#1b61c2',
                                confirmButtonText: 'Aceptar'
                            })
                            return
                        }
                        if(res.success == true){
                            swal({
                                title: 'Eliminado',
                                text: res.message,
                                type: 'success',
                                confirmButtonColor: '#1b61c2',
                                confirmButtonText: 'Aceptar'
                            }).then(function() {
                                window.location.href = 'documentos';
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        swal(
                            'Error',
                            'No se pudo eliminar el documento',
                            'error'
                        );
                    }
                });
        });
    });
});
</script>

</body>
</html>