<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas_casos.class.php");

$idEncuesta = $_POST['idEncuesta'];

$encuestasCasos = new EncuestasCasos();

$arrayEncuestasCasos = $encuestasCasos->getIdEncuestasCasosWhitJoins($idEncuesta);

echo json_encode ($arrayEncuestasCasos);

?>