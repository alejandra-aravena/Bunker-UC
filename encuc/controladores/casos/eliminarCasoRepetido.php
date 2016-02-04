<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/casos.class.php");

$idCasoRepetido=$_POST["idCasoRepetido"];

$casoRepetido = new Casos();

$delCasoRepetido = $casoRepetido->delCasoRepetidoById($idCasoRepetido);

if ($idCasoRepetido) {
	echo "ok";
}
else
	echo "error";

?>