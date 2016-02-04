<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_casos.class.php");
require_once("../../modelo/casos.class.php");

$casos = new Casos();

$arrayCasos = $casos->getAllCasosWhitJoins();

$estadosCasos = new EstadosCasos();

$correctas = 0;
$incorrectas = 0;
$filasIncorrectas = array();
foreach ($arrayCasos AS $key=>$row) {
	$add_caso = $estadosCasos->addEstadoCasoInicial($row->id_caso);
	if ($add_caso) {
		$correctas++;
	} else {
		$incorrectas++;
		$filasIncorrectas[] = $row->id_caso;
	}
}

$resultado = array(
				'correctas' 		=> $correctas,
				'incorrectas' 		=> $incorrectas,
				'filasIncorrectas'	=> $filasIncorrectas
			);
echo json_encode($resultado);

?>