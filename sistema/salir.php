<?php 

//Inicializamos la sesión
session_start();
//Destruimos todas las sesiones
session_destroy();

//Regresamos una carpeta 
header('location: ../');

 ?>