<?php 
include "../conexion.php";
			session_start();


			if(empty($_REQUEST['id'])){
				header('Location: ../sistema/lista_clientes.php');
				
			}
			$idcliente = $_REQUEST['id'];
			$sql = mysqli_query($conexion, "SELECT c.*,tc.nombre AS tipocliente, td.nombre AS tipodocumento, u.nombre AS usuario
                                           FROM cliente c
                                           JOIN tipo_cliente tc ON c.tipo_cliente_id = tc.id
                                           JOIN tipo_documento td ON c.tipo_documento_id = td.id
                                           JOIN usuario u ON c.usuario_id  = u.idusuario
                                           WHERE idcliente = $idcliente"); 
			
			$result_sql = mysqli_num_rows($sql);
			if($result_sql==0){
				header('Location: ../sistema/lista_clientes.php');
			} else {
				$option = '';
				while ($data = mysqli_fetch_array($sql)) {
					$idcliente  = $data['idcliente'];
					$nombre = $data['nombre'];
					$tipocliente = $data['tipocliente'];
					$tipodocumento = $data['tipodocumento'];
					$numero = $data['num_documento'];
					$telefono = $data['telefono'];
					$direccion = $data['direccion'];
					$usuario = $_SESSION['iduser'];
					$idtipocliente = $data['tipo_cliente_id'];
					$tipocliente = $data['tipocliente'];
					$idtipodocumento = $data['tipo_documento_id'];
					$tipodocumento = $data['tipodocumento'];

					if ($idtipocliente >= 1) {
						$optionC = '<option value="'.$idtipocliente.'" select>'.$tipocliente.'</option>';

					} 
					if ($idtipodocumento >= 1) {
						$optionD = '<option value="'.$idtipodocumento.'" select>'.$tipodocumento.'</option>';

					} 
					
				}
			}

			include "../conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['numero']))
		{
			
		}else{

			$idcliente = $_POST['id'];
			$nombre = $_POST['nombre'];
			$tipocliente = $_POST['tipocliente'];
			$tipodocumento = $_POST['tipodocumento'];
			$numero = $_POST['numero'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$usuario = $_SESSION['iduser'];


			$query = mysqli_query($conexion, "SELECT * FROM cliente 
											  WHERE (num_documento = '$numero' AND idcliente != $idcliente) 
											  OR (nombre = '$nombre' AND idcliente != $idcliente)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				
			}else{

				$sql_update = mysqli_query($conexion, "UPDATE cliente 
														SET num_documento = '$numero', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion', tipo_cliente_id = '$tipocliente', tipo_documento_id = '$tipodocumento' 
														WHERE idcliente = $idcliente;");

				if($sql_update){
					header('Location: ../sistema/lista_clientes.php');
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
		if(empty($_POST['nombre']) || empty($_POST['numero']))
		{
			echo '<div class="alert"><p class="msg_error">El nombre del cliente y numero del documento son necesarios.</p></div>';
		}else{

			$idcliente = $_POST['id'];
			$nombre = $_POST['nombre'];
			$tipocliente = $_POST['tipocliente'];
			$tipodocumento = $_POST['tipodocumento'];
			$numero = $_POST['numero'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];
			$usuario = $_SESSION['iduser'];


			$query = mysqli_query($conexion, "SELECT * FROM cliente 
											  WHERE (num_documento = '$numero' AND idcliente != $idcliente) 
											  OR (nombre = '$nombre' AND idcliente != $idcliente)");

			$result = mysqli_fetch_array($query);

			if($result > 0){
				echo '<div class="alert"><p class="msg_error">El numero de documento o el nombre del cliente ya existe.</p></div>';
			}else{

				$sql_update = mysqli_query($conexion, "UPDATE cliente 
														SET num_documento = '$numero', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion', tipo_cliente_id = '$tipocliente', tipo_documento_id = '$tipodocumento' 
														WHERE idcliente = $idcliente;");

				if($sql_update){
					
				}else{
					echo '<div class="alert"><p class="msg_error">Error al actualizar el cliente.</p></div>';
				}

			}


		}
	}
?>
			<form action="" method="POST">
			<input type="hidden" name="id" value="<?php echo $idcliente; ?>">
			<div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                                
                            </div>
                            <div class="form-group">
                                <label for="tipocliente">Tipo de Cliente</label>
                                <?php 
									$query_tipo_cliente =  mysqli_query($conexion, "SELECT * FROM tipo_cliente");
									
									$result_tipo_cliente = mysqli_num_rows($query_tipo_cliente);
								?>
                                <select name="tipocliente" id="tipocliente" class="form-control nonItemOne" >
									<?php 
										echo $optionC;
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
                                <select name="tipodocumento" id="tipodocumento" class="form-control nonItemOne" >
									<?php 
										echo $optionD;
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
                                <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $numero; ?>" >
                            </div>
                            
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>">
                            </div>
							<div class="form-group">
								<button type="submit" class="btn btn-success btn-info" href="lista_clientes.php"><i class='fa fa-save'> </i> Guardar</button>
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

