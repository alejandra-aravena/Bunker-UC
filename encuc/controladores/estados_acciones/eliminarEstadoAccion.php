<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_acciones.class.php");

$id_estado=$_POST["id_estado"];
$id_accion=$_POST["id_accion"];

$estadoAccion = new EstadosAcciones();

$delEstadoAccion = $estadoAccion->del_EstadoAccionByIds($id_estado, $id_accion);

if ($delEstadoAccion) {
	echo "ok";
}
else
	echo "error";

?>