<?php 
include "../conexion.php";
			session_start();
			if($_SESSION['rol'] != 1){
    				header('Location: ./');
  			}

			include "../conexion.php";

			if(empty($_GET['id'])){
				header('Location: ../sistema/lista_usuarios.php');
				
			}
			$iduser = $_GET['id'];
			$sql = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario=$iduser"); 
			
			$result_sql = mysqli_num_rows($sql);
			if($result_sql==0){
				header('Location: ../sistema/lista_usuarios.php');
			} else {
				$option = '';
				while ($data = mysqli_fetch_array($sql)) {
					$iduser  = $data['idusuario'];
					$nombre  = $data['nombre'];
					$correo  = $data['correo'];
					$usuario = $data['usuario'];
					$idrol   = $data['idrol'];
					$rol     = $data['rol'];

					if ($idrol >= 1) {
						$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';

					} 
					
				}
			}
			
		include "../conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol']))
		{
			echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">Todos los campos son obligatorios.</p></div>';
		}else{

			$idUsuario = $_POST['idUsuario'];
			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = md5($_POST['clave']);
			$rol    = $_POST['rol'];


			$query = mysqli_query($conexion,"SELECT * FROM usuario 
													   WHERE (usuario = '$user' AND idusuario != $idUsuario)
													   OR (correo = '$email' AND idusuario != $idUsuario) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">El usuario o el correo ya existe.</p></div>';
			}else{

				if(empty($_POST['clave']))
				{

					$sql_update = mysqli_query($conexion,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',rol='$rol'
															WHERE idusuario= $idUsuario ");
				}else{
					$sql_update = mysqli_query($conexion,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',clave='$clave', rol='$rol'
															WHERE idusuario= $idUsuario ");

				}

				if($sql_update){
					header('Location: ../sistema/lista_usuarios.php');
				}else{
					
				}

			}


		}

	}

			?>
	<?php include "includes/headers.php"; ?>

<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <i class='fa fa-edit'> </i> Usuarios
                <small>Editando</small>
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
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario'])  || empty($_POST['rol']))
		{
			echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">Todos los campos son obligatorios.</p></div>';
		}else{

			$idUsuario = $_POST['idUsuario'];
			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = md5($_POST['clave']);
			$rol    = $_POST['rol'];


			$query = mysqli_query($conexion,"SELECT * FROM usuario 
													   WHERE (usuario = '$user' AND idusuario != $idUsuario)
													   OR (correo = '$email' AND idusuario != $idUsuario) ");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">El usuario o el correo ya existe.</p></div>';
			}else{
				if(empty($_POST['clave']))
				{

					$sql_update = mysqli_query($conexion,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',rol='$rol'
															WHERE idusuario= $idUsuario ");
				}else{
					$sql_update = mysqli_query($conexion,"UPDATE usuario
															SET nombre = '$nombre', correo='$email',usuario='$user',clave='$clave', rol='$rol'
															WHERE idusuario= $idUsuario ");

				}
				if($sql_update){
					
				}else{
					echo '<div style="width: 100%; background: #66e07d66; border-radius: 5px; margin: 20px auto;"><p style="color: #e65656; font-size: 14px;">Error al actualizar el usuario.</p></div>';
				}
			}
		}
	}
?>
			<form action="" method="POST">
			<input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
			<div class="form-group">

				<label for="nombre" >Nombre</label>
				<input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" placeholder="Nombre Completo">
			</div>
			<div class="form-group">
				<label for="correo" >Correo electrónico</label>
				<input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" placeholder="Correo Electrónico">
			</div>
			<div class="form-group">
				<label for="usuario" >Usuario</label>
				<input type="text" value="<?php echo $usuario; ?>" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
			</div>
			<div class="form-group">
				<label for="clave" >Contraseña</label>
				<input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña">
			</div>
				<!--<label for="rclave" >Repetir Contraseña</label>
					<input type="password" name="rclave" id="rclave" placeholder="Confirmar Contraseña">-->
					<label for="rol">Tipo usuario</label>
					<?php 
					include "../conexion.php";
					$query_rol =  mysqli_query($conexion, "SELECT * FROM rol");
					
					$result_rol = mysqli_num_rows($query_rol); 
					?>
					<div class="form-group">
					<select name="rol" id="rol" class="form-control nonItemOne" >
					<?php 
						echo $option;
						if ($result_rol > 0) {
							while ($rol = mysqli_fetch_array($query_rol)) {
					?>
							<option value="<?php echo $rol["idrol"]; ?> "><?php echo $rol["rol"]; ?></option>
					<?php
							}
						}
					?>

					</select>
					</div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-info" href="lista_usuarios.php"><i class='fa fa-save'> </i> Guardar</button>
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

