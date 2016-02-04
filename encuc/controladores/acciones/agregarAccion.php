<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/acciones.class.php");

$accion = $_POST["accion"];

$acciones = new Acciones();

$addAccion = $acciones->add_accion($accion);

if ($addAccion) {
	echo "ok";
}
else
	echo "error";

?>