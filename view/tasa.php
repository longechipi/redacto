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
                <h5>Tasa BCV</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banco</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>FECHA</th>
                        <th>MONTO</th>
                        <th class="datatable-nosort">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT B.id_ban, B.banco, B.cod_ban, B.id_sta, E.nom_sta FROM banco B 
                    LEFT JOIN estatus E ON B.id_sta = E.id_sta";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){
                        $id = $row['id_ban'];
                        $banco = $row['banco'];
                        $codigobanco = $row['cod_ban'];
                        $nom_sta = $row['nom_sta'];
                        $estatus = $row['id_sta'];
                        ?>
                        <tr>
                            <td><?php echo $banco;?></td>
                            <td><?php echo $codigobanco;?></td>
                            <td><?php echo $nom_sta;?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#" data-ban-id=<?php echo $row['id_ban']?>><i class="dw dw-edit2"></i> Editar</a>
                                    </div>
                                </div>
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
        var banId = $(this).data('ban-id');
        var form = $('<form method="POST" action="edit_banco"></form>');
        form.append('<input type="hidden" name="ban_id" value="' + banId + '">');
        $('body').append(form);
        form.submit();
    });
});
</script>

</body>
</html>