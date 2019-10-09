<?php 
	session_start(); 
	if($_SESSION['rol'] != 1){
    	header('Location: ./');
  	}

	?>

	<?php include "../sistema/includes/headers.php"; ?>

<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <i class='fa fa-plus'> </i> Proveedor
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
				<?php if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']) || empty($_POST['fecha'])): ?>
				<?php echo '<div class="alert"><p class="msg_error">Todos los campos son obligatorios.</p></div>'; ?>
				

				<?php else:?>
					<?php 
						$nombre = $_POST['proveedor'];
						$contacto = $_POST['contacto'];
						$telefono = $_POST['telefono'];
						$direccion = $_POST['direccion'];
						$fecha = $_POST['fecha'];

						$query = mysqli_query($conexion, "SELECT * FROM proveedor WHERE proveedor = '$nombre'");
						$resultado = mysqli_fetch_array($query); 
						if($resultado > 0):?>
								<?php echo '<div class="alert"><p class="msg_error">El usuario o el correo ya existe.</p></div>'; ?>
						<?php else: ?>
							<?php $query_insert = mysqli_query($conexion, "INSERT INTO proveedor(proveedor, contacto, telefono, direccion, fecha) VALUES('$nombre','$contacto','$telefono','$direccion','$fecha')");
						if ($query_insert):?>
							<?php echo '<div class="alert"><p class="msg_save">Proveedor registrado exitosamente</p></div>'; ?>
						<?php else: ?>
							<?php echo '<div class="alert"><p class="msg_error">Error al crear el usuario.</p></div>'; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif;?>

			
			<form action="" method="POST">
				<div class="form-group">
				<label for="proveedor" >Nombre</label>
				<input type="text" class="form-control" name="proveedor" id="proveedor" placeholder="Nombre del proveedor">
			</div>
			<div class="form-group">
				<label for="contacto" >Contacto</label>
				<input type="text" class="form-control" name="contacto" id="contacto" placeholder="Nombre del contacto del proveedor">
			</div>
			<div class="form-group">
				<label for="telefono" >Telefono</label>
				<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono del contacto del proveedor">
			</div>
			<div class="form-group">
				<label for="direccion" >Dirección</label>
				<input type="text" class="form-control " name="direccion" id="direccion" placeholder="Ubicacion del proveedor">
			</div>
			<div class="form-group">
				<?php date_default_timezone_set('America/El_Salvador'); $fecha_actual = date("d/m/Y"); ?>
                <input type="hidden" value="<?php echo $fecha_actual?>" class="form-control" name="fecha" readonly>
			</div>
				
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-info"><i class='fa fa-save'></i> Guardar</button>
						<a href="lista_proveedores.php" class="btn btn-success btn-danger"><i class='fa fa-ban'> </i><?php mysqli_close($conexion); ?> Cancelar</a> 
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

