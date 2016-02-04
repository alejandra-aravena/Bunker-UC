<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_acciones.class.php");

$id_estado=$_POST["id_estado"];
$id_accion=$_POST["id_accion"];
$prioridad=$_POST["prioridad"];

$estadoAccion = new EstadosAcciones();

$addEstadoAccion = $estadoAccion->add_estado_accion($id_estado, $id_accion, $prioridad);

if ($addEstadoAccion) {
	echo "ok";
}
else
	echo "error";
?>