<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/casos.class.php");

$casos = new Casos();

$arrayCasos = $casos->getAllCasosRepetidos();

echo json_encode ($arrayCasos);

?>