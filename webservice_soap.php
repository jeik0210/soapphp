<?php 
	require_once 'lib/nusoap.php';

	$username = "root";
	$password = "";
	$hostname = "localhost";

	$bdhandle = mysqli_connect($hostname,$username,$password,"bdlibro") or die ("No es posible conectarse a mysql");
	//$seleccion = mysqli_select_db($bdhandle,"BdLibros") or die ("Base de datos no disponible");
	function muestralibros(){
		$resultado = mysqli_query($bdhandle,"select * from libros");
		while ($row = mysqli_fetch_array($resultado)) {
			$all[] = $row;
		}

		return $all;
	}
	function mostrarplanetas(){
		$planetas = "Jeison samir ";
		return $planetas;
	}
	/*
	function muestraimagen($categoria){
		if ($categoria == 'espacio') {
			$imagen = 'imagen.jpg';
		}else{
			$imagen = 'imagen2.jpg';
		}

		$resultado = '<img src="img/'.$imagen.'">';

		return $resultado;
	}
	*/
	if (!isset($HTTP_RAW_POST_DATA)) {
		$HTTP_RAW_POST_DATA = file_get_contents('php://input');
	}
	
	$server = new soap_server();
	$server->configureWSDL("Info Blog","urn:infoblog");
	$server->register("muestraplanetas");
	$server->register("mostrarplanetas",
		array(), //parametro
		array('return' => 'xsd:string'), //respuesta
		'urn:infoblog', //namespace
		'urn:infoblog#muestraplanetas', //accion
		'rpc', //estilo
		'encoded', //uso
		'Muestra el contenido para el blog' //descripcion
		);
	/*
	$server->register("muestraimagen",
		array('categoria'=>'xsd:string'), //parametro
		array('return' => 'xsd:string'), //respuesta
		'urn:infoblog', //namespace
		'urn:infoblog#muestraimagen', //accion
		'rpc', //estilo
		'encoded', //uso
		'Muestra una imagen variable' //descripcion		
		);
		*/
	$server->service($HTTP_RAW_POST_DATA);
?>