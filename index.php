<?php 
	require_once 'lib/nusoap.php';
	//require_once 'webservice_soap.php';
	$cliente = new nusoap_client("http://localhost/soapbasico/webservice_soap.php?wsdl&debug=0",'wsdl');
	$planetas = $cliente->call("mostrarplanetas");
	$libros = $cliente->call("muestralibros");
	//$imagen = $cliente->call("muestraimagen",array("categoria"=>"espacio"));
	echo "<h2>Mis Libros</h2>";
	echo "<ul>";
		if (is_array($libros)){
		foreach ( (array) $libros as $items) {
		echo '<li>';
		echo '<b>'.$items['Autor'].'</b>';
		echo $items['Titulo'];
		echo $items['Sinopsis'];
		echo '<br><br</li>';
		}
	}
	echo "</ul>";
	echo "</hr>";
	echo "<h2>estos son los planes</h2>";
	echo "<p>".$planetas."</p>";
	//echo $imagen;

?>