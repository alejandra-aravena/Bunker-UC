<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_casos.class.php");

$estadosCasos = new EstadosCasos();

$arrayEstadosCasos = $estadosCasos->getAllEstadosCasosWhitJoins();

echo json_encode ($arrayEstadosCasos);

?>