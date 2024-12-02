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
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th class="datatable-nosort">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT IV.id_user, IV.monto_usd, IV.fecha, IV.num_doc, IV.id_sta, E.nom_sta
                    FROM importe_venta IV
                    INNER JOIN estatus E ON IV.id_sta = E.id_sta
                    WHERE IV.id_user = $id_user";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $row['num_doc']; ?></td>
                            <td><?php echo $row['monto_usd'] . ' ' .'$'; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td><?php echo $row['nom_sta']; ?></td>
                            <td>
                            <?php if($row['id_sta'] == 3){?> 
                                <a class="btn btn-primary pago" href="#" data-id-doc=<?php echo $row['num_doc']?>><i class="icon-copy dw dw-credit-card"></i> Pagar</a>
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
});
</script>

</body>
</html>