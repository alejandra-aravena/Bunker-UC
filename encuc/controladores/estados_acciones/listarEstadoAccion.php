<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_acciones.class.php");

$EstadosAcciones = new EstadosAcciones();

$arrayEstadosAcciones = $EstadosAcciones->get_allEstadosAcciones();

echo json_encode ($arrayEstadosAcciones);

?>