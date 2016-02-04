<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/acciones.class.php");

$accion=$_POST["accion"];
$id_accion=$_POST["id_accion"];

$acciones = new Acciones();

$editAccion = $acciones->edit_accion($id_accion, $accion); 

if ($editAccion) {
	echo "ok";
}
else
	echo "error";

?>