<?php 


	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'ventasyfacturacion';


	$conexion = @mysqli_connect($host,$user,$password,$db);

	if (!$conexion) {
		echo "Error en la conexión";
	}

 ?>