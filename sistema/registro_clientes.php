<?php 
	session_start(); 
	

	?>

	<?php include "../sistema/includes/headers.php"; ?>

<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <i class='fa fa-user-plus'> </i> Cliente
                <small>Nuevo</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
			
			<?php 
			include "../conexion.php";

			if(!empty($_POST)):?>
				<?php  $alert='';?>
				<?php if(empty($_POST['nombre']) || empty($_POST['tipocliente']) || empty($_POST['tipodocumento']) || empty($_POST['numero'])): ?>
				<?php echo '<div class="alert"><p class="msg_error">Todos los campos son obligatorios.</p></div>'; ?>
				

				<?php else:?>
					<?php 

						$nombre = $_POST['nombre'];
						$tipocliente = $_POST['tipocliente'];
						$tipodocumento = $_POST['tipodocumento'];
						$numero = $_POST['numero'];
						$telefono = $_POST['telefono'];
						$direccion = $_POST['direccion'];
						$usuario = $_SESSION['iduser'];

						
						$query = mysqli_query($conexion, "SELECT * FROM cliente WHERE num_documento = '$numero' OR nombre = '$nombre'");
						$resultado = mysqli_fetch_array($query); 
						if($resultado > 0):?>
							<?php //header('location: ../sistema/lista_usuarios.php'); ?>
								<?php echo '<div class="alert"><p class="msg_error">El numero de documento o el nombre del cliente ya existe.</p></div>'; ?>
						<?php else: ?>

							<?php 
							
							$query_insert = mysqli_query($conexion, "INSERT INTO cliente(num_documento, nombre,telefono, direccion, usuario_id, tipo_cliente_id, tipo_documento_id) VALUES('$numero','$nombre','$telefono','$direccion','$usuario','$tipocliente','$tipodocumento')");
						if ($query_insert):?>
							<?php echo '<div class="alert"><p class="msg_save">Cliente creado exitosamente</p></div>'; ?>
						
						
						<?php else: ?>
							<?php echo '<div class="alert"><p class="msg_error">Error al crear el cliente.</p></div>'; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif;?>

			
			<form action="" method="POST">
							<div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="">
                                
                            </div>
                            <div class="form-group">
                                <label for="tipocliente">Tipo de Cliente</label>
                                <?php 
									$query_tipo_cliente =  mysqli_query($conexion, "SELECT * FROM tipo_cliente");
									
									$result_tipo_cliente = mysqli_num_rows($query_tipo_cliente);
								?>
                                <select name="tipocliente" id="tipocliente" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <?php 
										if ($result_tipo_cliente > 0) {
											while ($tipocliente = mysqli_fetch_array($query_tipo_cliente)) {
												?>
												<option value="<?php echo $tipocliente["id"]; ?>"><?php echo $tipocliente["nombre"]; ?></option>
												<?php
												}
											} 
									?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipodocumento">Tipo de Documento</label>
                                <?php 
									$query_tipo_documento =  mysqli_query($conexion, "SELECT * FROM tipo_documento");
									
									$result_tipo_documento = mysqli_num_rows($query_tipo_documento);
								?>
                                <select name="tipodocumento" id="tipodocumento" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <?php 
										if ($result_tipo_documento > 0) {
											while ($tipodocumento = mysqli_fetch_array($query_tipo_documento)) {
												?>
												<option value="<?php echo $tipodocumento["id"]; ?>"><?php echo $tipodocumento["nombre"]; ?></option>
												<?php
												}
											} 
									?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="numero">Numero del Documento:</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="" >
                            </div>
                            
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion">
                            </div>
				
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-info"><i class='fa fa-save'></i> Guardar</button>
						<a href="../sistema/lista_clientes.php" class="btn btn-success btn-danger"><i class='fa fa-ban'> </i> Cancelar</a> 
                     </div>

				</form>


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


			

                       
                           
                            


		<?php include "includes/footer.php" ?>

