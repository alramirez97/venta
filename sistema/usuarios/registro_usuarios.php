<?php 
	session_start(); 
	if($_SESSION['rol'] != 1){
    	header('Location: ./');
  	}

	?>

	<?php include "includes/headers.php"; ?>

<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <i class='fa fa-user-plus'> </i> Usuarios
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
				<?php if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])): ?>
				<?php echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">Todos los campos son obligatorios.</p></div>'; ?>
				

				<?php else:?>
					<?php $nombre = $_POST['nombre'];
						$email = $_POST['correo'];
						$user = $_POST['usuario'];
						$clave = md5($_POST['clave']);
						$rol = $_POST['rol'];

						$query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
						mysqli_close($conexion);
						$resultado = mysqli_fetch_array($query); 
						if($resultado > 0):?>
							<?php //header('location: ../sistema/lista_usuarios.php'); ?>
								<?php echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">El usuario o el correo ya existe.</p></div>'; ?>
						<?php else: ?>
							<?php $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre, correo, usuario, clave, rol) VALUES('$nombre','$email','$user','$clave','$rol')");
						if ($query_insert):?>
							<?php echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #126e00; font-size: 14px;">Usuario creado exitosamente</p></div>'; ?>
						
						
						<?php else: ?>
							<?php echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">Error aal crear el usuario.</p></div>'; ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif;?>

			
			<form action="" method="POST">
				<div class="form-group">
				<label for="nombre" >Nombre</label>
				<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre Completo">
			</div>
			<div class="form-group">
				<label for="correo" >Correo electrónico</label>
				<input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electrónico">
			</div>
			<div class="form-group">
				<label for="usuario" >Usuario</label>
				<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
			</div>
			<div class="form-group">
				<label for="clave" >Contraseña</label>
				<input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña">
			</div>
				<!--<label for="rclave" >Repetir Contraseña</label>
					<input type="password" name="rclave" id="rclave" placeholder="Confirmar Contraseña">-->
					<label for="rol">Tipo usuario</label>
					<?php 
					$query_rol =  mysqli_query($conexion, "SELECT * FROM rol");
					mysqli_close($conexion);
					$result_rol = mysqli_num_rows($query_rol);
					?>
					<div class="form-group">
					<select name="rol" id="rol" class="form-control">
						<?php 
						if ($result_rol > 0) {
							while ($rol = mysqli_fetch_array($query_rol)) {
								?>
								<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
								<?php
								}
							} ?>
					</select>
				</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-info"><i class='fa fa-save'></i> Guardar</button>
						<a href="../sistema/lista_usuarios.php" class="btn btn-success btn-danger"><i class='fa fa-ban'> </i> Cancelar</a> 
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

