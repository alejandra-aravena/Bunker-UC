<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/acciones.class.php");

$id_accion=$_POST["id_accion"];

$acciones = new Acciones();

$delAccion = $acciones->del_accionById($id_accion);

if ($delAccion) {
	echo "ok";
}
else
	echo "error";

?>