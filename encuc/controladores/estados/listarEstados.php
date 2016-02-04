<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados.class.php");

$estados = new Estados();

$arrayEstados = $estados->get_allEstados();

echo json_encode ($arrayEstados);

?>