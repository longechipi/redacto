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
                <h5>Listado de Privilegios</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">

            <hr>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Fecha del Pago</th>
                        <th>Tipo del Pago</th>
                        <th>Monto</th>
                        <th>Referencia</th>
                        <th>Fecha del Reporte</th>
                        <th>Estatus</th>
                        <th class="datatable-nosort">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT RP.id_pag, RP.id_user, CONCAT(U.apellido, ' ', U.nombre) AS nom_user,
                        RP.fecha_pago, RP.monto, RP.tip_pag, FP.tip_pago, RP.refe, RP.id_ban, B.banco,
                        RP.capture, RP.num_doc, RP.fec_cargo, RP.id_sta, E.nom_sta
                        FROM reporte_pago RP
                        LEFT JOIN users U ON RP.id_user = U.id_user
                        LEFT JOIN forma_pago FP ON RP.tip_pag = FP.id_pag
                        LEFT JOIN banco B ON RP.id_ban = B.id_ban
                        LEFT JOIN estatus E ON RP.id_sta = E.id_sta";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){
                        ?>
                        <tr>
           
                            <td><?php echo trim($row['fecha_pago']); ?></td>
                            <td><?php echo strtoupper(trim($row['tip_pago'])); ?></td>
                            <td><?php echo trim($row['monto']); ?></td>
                            <td><?php echo strtoupper(trim($row['refe'])); ?></td>
                            <td><?php echo trim($row['fec_cargo']);?></td>
                            <td><?php echo trim($row['nom_sta']);?></td>
                            <td>
                                <a class="btn btn-primary sm" href="#" data-tas-id=<?php echo $row['id_pag']?>><i class="icon-copy dw dw-eye"></i> Detalle</a>
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

    $(document).on('click', '.dropdown-item', function() {
        var id_pri = $(this).data('id_pri');
        var form = $('<form method="POST" action="edit_privilegio"></form>');
        form.append('<input type="hidden" name="id_pri" value="' + id_pri + '">');
        $('body').append(form);
        form.submit();
    });
});
</script>

</body>
</html>