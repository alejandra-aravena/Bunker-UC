<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/acciones.class.php");

$acciones = new Acciones();

$arrayAcciones = $acciones->get_allAcciones();

echo json_encode ($arrayAcciones);

?>