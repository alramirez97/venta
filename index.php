<?php 

	$alert = '';


	session_start();

	if (!empty($_SESSION['active'])) {
		
		header('location: sistema/');
	}else{
//Si existe POST; es decir que el usuario dio clic en ingresar
	if (!empty($_POST)) {

		//Si esta vacio la variable usuario que es enviada por el metodo POST 
		//o si esta vacio el campo contraseña enviado por el metodo POST  
		 if (empty($_POST['usuario']) || empty($_POST['clave'])) {
		 	
		 	$alert = 'Ingrese su usuario y su clave';

		 }
		 else{

		 	require_once "conexion.php";

		 	$user = mysqli_real_escape_string($conexion,$_POST['usuario']);
		 	$pass = md5(mysqli_real_escape_string($conexion,$_POST['clave']));

		 	$query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
		 	
		 	$resultado = mysqli_num_rows($query);


		 	if ($resultado > 0) {

		 		//Almcenamos la consulta query en un array
		 		$data = mysqli_fetch_array($query);

		 		$_SESSION['active'] = true;
		 		$_SESSION['iduser'] = $data['idusuario'];
		 		$_SESSION['nombre'] = $data['nombre'];
		 		$_SESSION['email']  = $data['email'];
		 		$_SESSION['user']   = $data['usuario'];
		 		$_SESSION['rol']    = $data['rol'];


		 		header('location: sistema/');

		 	}else{

		 		$alert = 'El usuario o la clave son incorrectos';
		 		session_destroy();
		 	}


		 }
	}

	}

	

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | Sistema de ventas y facturación</title>
	<!--<link rel="stylesheet" type="text/css" href="css/style.css">-->
	  <link rel="stylesheet" href="assets/template/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/template/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="assets/template/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/template/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/template/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/template/dist/css/skins/_all-skins.min.css">
</head>
<body>
	<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <h2>SISTEMA DE VENTAS</h2>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Introduzca sus datos de ingreso</p>

            <?php 
		        $alert = '';
				
				if (!empty($_SESSION['active'])): ?>
					<?php header('location: sistema/'); ?>
					<?php else: ?>
						<?php if (!empty($_POST)): ?>
							<?php if (empty($_POST['usuario']) || empty($_POST['clave'])): ?>
					              <div class="alert alert-danger">
					                <p><?php echo "Ingrese su usuario y su clave"; ?></p>
					              </div>
					        <?php else: ?>
					        	<?php 
					        		require_once "conexion.php";
								 	$user = mysqli_real_escape_string($conexion,$_POST['usuario']);
								 	$pass = md5(mysqli_real_escape_string($conexion,$_POST['clave']));
								 	$query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario='$user' AND clave='$pass'");
								 	$resultado = mysqli_num_rows($query);
								 	if ($resultado > 0): ?>
							<?php //Almcenamos la consulta query en un array
						 		$data = mysqli_fetch_array($query);
						 		$_SESSION['active'] = true;
						 		$_SESSION['iduser'] = $data['idusuario'];
						 		$_SESSION['nombre'] = $data['nombre'];
						 		$_SESSION['email']  = $data['email'];
						 		$_SESSION['user']   = $data['usuario'];
						 		$_SESSION['rol']    = $data['rol'];
						 		header('location: sistema/'); ?>
						 		<?php else: ?>
						 			<div class="alert alert-danger">
					                <p><?php echo "El usuario o la clave son incorrectos"; ?></p>
					              </div>
              		<?php endif; ?>
              	<?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>


     		<form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Usuario" name="usuario">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="clave">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/template/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/template/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
