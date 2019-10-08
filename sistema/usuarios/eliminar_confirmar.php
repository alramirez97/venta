<?php 
session_start();
if($_SESSION['rol'] != 1){
    header('Location: ./');
  }
include "../conexion.php";

    if (!empty($_POST)) {

        if ($_POST['idusuario'] == 1) {
           header('Location: lista_usuarios.php');
           mysqli_close($conexion);
           exit;
        } 
        
        
        $idusuario = $_POST['idusuario'];
        //$query_delete = mysqli_query($conexion, "DELETE FROM usuario WHERE idusuario = $idusuario");
        $query_delete = mysqli_query($conexion, "UPDATE usuario SET estado = 0 WHERE idusuario = $idusuario");
        mysqli_close($conexion);
        if ($query_delete) {
            header('Location: lista_usuarios.php');

        } else {
            echo "Error al eliminar";
        }
        
        
    } 
    
    
    if (empty(($_REQUEST['id'])) || $_REQUEST['id'] == 1) {
        header('Location: lista_usuarios.php');
        mysqli_close($conexion);
    } else {
        
        $idusuario = $_REQUEST['id'];

        $query =  mysqli_query($conexion, "SELECT u.nombre, u.usuario, r.rol
                                            FROM usuario u
                                            INNER JOIN rol r
                                            ON u.rol = r.idrol
                                            WHERE u.idusuario = $idusuario");
        mysqli_close($conexion);
        $result = mysqli_num_rows($query);
        if ($result > 0) {
            while ($data = mysqli_fetch_array($query)) {
                $nombre = $data['nombre'];
                $usuario = $data['usuario'];
                $rol = $data['rol'];
            }
        } else {
           header('Location: lista_usuarios.php');
        }
        
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
            <section class="contents">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <br>
                        <?php //if(empty($_POST)): ?>
                        <i class="fa fa-user-times fa-5x colorC"></i>
                            
                        <form action="" method="POST">
                            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                            <div class="form-group"><h2>¿Está seguro que desea eliminar el usuario?</h2></div>
                            <hr>
                            <div class="form-group">
                                <p><strong>Nombre: </strong><?php echo $nombre;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Usuario: </strong><?php echo $usuario;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Tipo de usuario: </strong><?php echo $rol;?></p>
                            </div>
                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-danger" href="../sistema/lista_usuarios.php" > <i class="fa fa-trash"></i> Aceptar</button>
                                <a href="../sistema/lista_usuarios.php" class="btn btn-success btn-info"><i class='fa fa-ban'> </i> Cancelar</a> 
                            </div>
                        </form>

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