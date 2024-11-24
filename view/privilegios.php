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
                    <li class="breadcrumb-item active" aria-current="page">Privilegios</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="reg_privilegio" class="btn btn-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-pencil-1"></i>&nbsp;REGISTRAR PRIVILEGIO</a>
                </div>
            </div>
            <hr>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>Privilegio</th>
                        <th>Usuarios</th>
                        <th>Estatus</th>
                        <th class="datatable-nosort">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT P.id_pri, P.nom_pri, P.id_sta, E.nom_sta, COUNT(id_user) AS total
                    FROM privilegios P
                    LEFT JOIN estatus E ON P.id_sta = E.id_sta
                    LEFT JOIN users_privilegios UP ON P.id_pri = UP.id_pri
                    GROUP BY P.id_pri, P.nom_pri, P.id_sta, E.nom_sta";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo strtoupper($row['nom_pri']);?></td>
                            <td><?php echo strtoupper($row['total']); ?></td>
                            <td><?php echo $row['nom_sta'];?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#" data-id_pri=<?php echo $row['id_pri']?>><i class="dw dw-edit2"></i> Editar</a>
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