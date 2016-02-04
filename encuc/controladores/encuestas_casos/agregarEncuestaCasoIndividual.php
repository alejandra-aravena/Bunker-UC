<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas_casos.class.php");

$idEncuesta=$_POST["idEncuesta"];
$idCaso=$_POST["idCaso"];

$EncuestasCasos = new EncuestasCasos();

if (!$EncuestasCasos->getEncuestaByCaso($idCaso)) {
	$addEC = $EncuestasCasos->add_encuesta_caso($idCaso, $idEncuesta);
	if ($addEC) {
		echo "ok";
	}
	else
		echo "error";
		
} else {
	$editEC = $EncuestasCasos->edit_encuesta_caso($idCaso, $idEncuesta);
	if ($editEC) {
		echo "ok";
	}
	else
		echo "error";
}


?>