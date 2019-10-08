<?php 
  session_start();
  if($_SESSION['rol'] != 1){
    header('Location: ./');
  }
	include "../conexion.php";

 ?>

 <?php include "includes/headers.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class='fa fa-users'> </i>
        Usuarios
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="registro_usuarios.php" class="btn btn-primary btn-flat"><span class="fa fa-user-plus"></span> Agregar Usuario</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
				<tr>
					<th>#</th>
					<th>Nombre</th>
					<th>Correo</th>
          <th>Usuario</th>
					<th>Rol</th>
					<th>Acciones</th>
				</tr>
			</thead>
            <tbody>
            		<?php 
					$query = mysqli_query($conexion,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol=r.idrol WHERE estado = 1");
          mysqli_close($conexion);
					$resultado = mysqli_num_rows($query);
					if ($resultado > 0) {
					while ($data = mysqli_fetch_array($query)) {

					?>
          <tr>
            <td><?php echo $data["idusuario"];?></td>
						<td><?php echo $data["nombre"]; ?></td>
						<td><?php echo $data["correo"]; ?></td>
            <td><?php echo $data["usuario"]; ?></td>
						<td><?php echo $data["rol"] ?></td>
          <?php $datausuario = $data["idusuario"]."*".$data["nombre"]."*".$data["correo"]."*".$data["usuario"]."*".$data["rol"];?>
           <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-view-producto" data-toggle="modal" data-target="#modal-default" value="<?php echo $datausuario;?>">
                    <span class="fa fa-search"></span>
                    </button>
                    <a href="editar_usuario.php?id=<?php echo $data["idusuario"]; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                    <?php if($data["idusuario"]!=1): ?>
								    <a href="eliminar_confirmar.php?id=<?php echo $data["idusuario"]; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                    <?php else: ?>
                  <?php endif; ?>
							 </div>
            </td>
          </tr>
        <?php

							}
						} 

			 		?>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion del Usuario</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">

        <!--
        <a href="<?php //echo base_url()?>mantenimiento/categorias/edit/<?php //echo $categoria->id;?>" class="btn btn-warning pull-left"><span class="fa"></span>Editar</a>-->
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

</section>



	<?php include "includes/footer.php" ?>
