<?php 
    
    if (empty(($_REQUEST['id']))) {
        header('Location: lista_usuarios.php');
    } else {
        include "../conexion.php";
        $idusuario = $_REQUEST['id'];

        $query =  mysqli_query($conexion, "SELECT u.nombre, u.usuario, r.rol
                                            FROM usuario u
                                            INNER JOIN rol r
                                            ON u.rol = r.idrol
                                            WHERE u.idusuario = $idusuario");
    }
    
 ?>
<?php include "includes/headers.php";?>


        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Usuarios
                <small>Eliminando</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


  <?php include "includes/footer.php" ?>
  
</body>
</html>