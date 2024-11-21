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
                <h5>Listado de Usuarios</h5>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                </ol>
            </nav>

        <div class="card-box pd-20 height-100-p mb-30">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="reg_usuario" class="btn btn-primary" rel="noopener noreferrer"><i class="icon-copy dw dw-pencil-1"></i>&nbsp;REGISTRAR USUARIO</a>
                </div>
            </div>
            <hr>
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th>NOMBRE </th>
                        <th>USUARIO</th>
                        <th>ESTATUS</th>
                        <th>PRIVILEGIO</th>
                        <th class="datatable-nosort">ACCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = "SELECT U.id_user, U.nombre, U.apellido, U.usuario, U.correo, U.telefono,
                    US.id_sta, E.nom_sta, UP.id_pri, P.nom_pri
                    FROM users U
                    LEFT JOIN users_status US ON U.id_user = US.id_user
                    LEFT JOIN estatus E ON US.id_sta = E.id_sta
                    LEFT JOIN users_privilegios UP ON U.id_user = UP.id_user
                    LEFT JOIN privilegios P ON UP.id_pri = P.id_pri";
                    $ares= $conn->query($a);
                    while($row = $ares->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo strtoupper($row['nombre']) . ' ' .strtoupper($row['apellido']);?></td>
                            <td><?php echo strtoupper($row['usuario']); ?></td>
                            <td><?php echo $row['nom_sta'];?></td>
                            <td><?php echo $row['nom_pri'];?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#" data-user-id=<?php echo $row['id_user']?>><i class="dw dw-edit2"></i> Editar</a>
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
        var userId = $(this).data('user-id');
        var form = $('<form method="POST" action="edit_usuario"></form>');
        form.append('<input type="hidden" name="user_id" value="' + userId + '">');
        $('body').append(form);
        form.submit();
    });
});
</script>

</body>
</html>