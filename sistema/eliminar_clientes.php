<?php 
session_start();

include "../conexion.php";


    if (empty(($_REQUEST['id']))  || $_REQUEST['id'] == 1) {
        header('Location: lista_clientes.php');
        mysqli_close($conexion);
    } else {
        
        $idcliente = $_REQUEST['id'];

        $query =  mysqli_query($conexion, "SELECT c.*,tc.nombre AS tipocliente, td.nombre AS tipodocumento, u.nombre AS usuario
                                           FROM cliente c
                                           JOIN tipo_cliente tc ON c.tipo_cliente_id = tc.id
                                           JOIN tipo_documento td ON c.tipo_documento_id = td.id
                                           JOIN usuario u ON c.usuario_id  = u.idusuario
                                           WHERE idcliente = $idcliente");
        $result = mysqli_num_rows($query);
        if ($result > 0) {
            while ($data = mysqli_fetch_array($query)) {
                $idcliente  = $data['idcliente'];
                    $nombre = $data['nombre'];
                    $tipocliente = $data['tipocliente'];
                    $tipodocumento = $data['tipodocumento'];
                    $numero = $data['num_documento'];
                    $telefono = $data['telefono'];
                    $direccion = $data['direccion'];
                    $usuarioid = $data['usuario_id'];
                    $usuario = $data['usuario'];
                    $idtipocliente = $data['tipo_cliente_id'];
                    $tipocliente = $data['tipocliente'];
                    $idtipodocumento = $data['tipo_documento_id'];
                    $tipodocumento = $data['tipodocumento'];
            }
            } else {
           header('Location: lista_clientes.php');
        }
    
    }

    if (!empty($_POST)) {

        if ($_POST['idcliente'] == 1) {
           header('Location: lista_clientes.php');
           mysqli_close($conexion);
           exit;
        } 
        
        
        $idcliente = $_POST['idcliente'];
        //$query_delete = mysqli_query($conexion, "DELETE FROM usuario WHERE idusuario = $idusuario");
        $query_delete = mysqli_query($conexion, "UPDATE cliente SET estado = 0 WHERE idcliente = $idcliente");
        if ($query_delete) {
            header('Location: lista_clientes.php');

        } else {
            echo "Error al eliminar";
        }
        
        
    } 
    
    
    
 ?>
<?php include "includes/headers.php";?>


        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                 <h1><i class="fa fa-trash"></i>
                Clientes
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
                            <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
                            <div class="form-group"><h2>¿Está seguro que desea eliminar el cliente?</h2></div>
                            <hr>
                            <div class="form-group">
                                <p><strong>Nombre del cliente: </strong><?php echo $nombre;?></p>
                            </div>
                            
                            <div class="form-group">
                                <p><strong>Tipo de Cliente: </strong><?php echo $tipocliente;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Tipo de Documento: </strong><?php echo $tipodocumento;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Numero de documento: </strong><?php echo $numero;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Telefono: </strong><?php echo $telefono;?></p>
                            </div>
                            <div class="form-group">
                                <p><strong>Direccion: </strong><?php echo $direccion;?></p>
                            </div>
                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-danger" href="../sistema/lista_clientes.php" > <i class="fa fa-trash"></i> Aceptar</button>
                                <a href="../sistema/lista_clientes.php" class="btn btn-success btn-info"><i class='fa fa-ban'> </i> Cancelar</a> 
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