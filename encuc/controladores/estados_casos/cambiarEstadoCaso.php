<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_casos.class.php");
require_once("../../modelo/modeloLS.php");

$idCaso = $_POST['idCaso'];
$idEstado = $_POST['idEstado'];
$idUsuario = $_POST['idUsuario'];
$valor = $_POST['valor'];
$ipEstacion = $_POST['ipEstacion'];

if($_POST['agenda']) {
	$agenda = $_POST['agenda'];
} else {
	$agenda = '0000-00-00 00:00:00';
}

//LIMESURVEY
$limeSurvey = new ModeloLineSurvey();
$rowLS = $limeSurvey->select_lastByIp($ipEstacion);

if ($rowLS) {
	$idLimeSurvey = $rowLS->id;
} else
	$idLimeSurvey = NULL;

//CDR

//Cambiar Estado
$estadosCasos = new EstadosCasos();
$add_EstadoCaso = $estadosCasos->addEstadoCaso($idCaso, $idEstado, $idUsuario, $valor, $agenda, $idLimeSurvey);

if ($add_EstadoCaso) {
	echo "ok";
	
	//FUERA DE SERVICIO
	if ($idEstado == 2) {
		$estadosCasos->sumarFueraDeServicio($idCaso);
	}
	//INTENTOS DE LLAMADA
	if (($idEstado == 3) || ($idEstado == 4) || ($idEstado == 5)) {
		$estadosCasos->sumarIntentoLlamada($idCaso);
	}
	
}
else
	echo "error";

?>