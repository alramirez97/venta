<?php 
  session_start();
  if($_SESSION['rol'] != 1){
    header('Location: ./');
  }
	include "../conexion.php";

 ?>

 <?php include "../sistema/includes/headers.php" ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><i class='fa fa-list-ul'> </i>
        Proveedores
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
                        <a href="registro_proveedores.php" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span><?php mysqli_close($conexion); ?> Agregar Proveedor</a>
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
          <th>Contacto</th>
          <th>Telefono</th>
          <th>Dirección</th>
          <th>Fecha</th>
					<th>Acciones</th>
				</tr>
			</thead>
            <tbody>
            		<?php 
                include "../conexion.php";
					$query = mysqli_query($conexion,"SELECT *
                                           FROM proveedor
                                           WHERE estado = 1");
          
					$resultado = mysqli_num_rows($query);
					if ($resultado > 0) {
					while ($data = mysqli_fetch_array($query)) {

					?>
          <tr>
            <td><?php echo $data["codproveedor"];?></td>
						<td><?php echo $data["proveedor"]; ?></td>
						<td><?php echo $data["contacto"]; ?></td>
            <td><?php echo $data["telefono"] ?></td>
            <td><?php echo $data["direccion"] ?></td>
            <td><?php echo $data["fecha"] ?></td>
          <?php $dataproveedor = $data["codproveedor"]."*".$data["proveedor"]."*".$data["contacto"]."*".$data["telefono"]."*".$data["direccion"];?>
           <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-view-proveedor" data-toggle="modal" data-target="#modal-default" value="<?php echo $dataproveedor;?>">
                    <span class="fa fa-search"></span>
                    </button>
                    <a href="editar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                    <?php //if($data["idcliente"]!=1): ?>
								    <a href="eliminar_proveedor.php?id=<?php echo $data["codproveedor"]; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
                    <?php //else: ?>
                  <?php //endif; ?>
							 </div>
            </td>
          </tr>
        <?php

							}
						} 
 mysqli_close($conexion); 
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
        <h4 class="modal-title">Informacion del Proveedor</h4>
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





	<?php include "../sistema/includes/footer.php" ?>
