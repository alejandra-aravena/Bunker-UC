<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas.class.php");

$encuestas = new Encuestas();

$arrayEncuestas = $encuestas->get_allEncuestas();

echo json_encode ($arrayEncuestas);

?>