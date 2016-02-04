<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas_casos.class.php");

$encuestasCasos = new EncuestasCasos();

$arrayEncuestasCasos = $encuestasCasos->getAllEncuestasSinCasos();

echo json_encode ($arrayEncuestasCasos);

?>