<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas.class.php");

$id_encuesta=$_POST["id_encuesta"];

$encuestas = new Encuestas();

$delEncuesta = $encuestas->del_encuestaById($id_encuesta);

if ($delEncuesta) {
	echo "ok";
}
else
	echo "error";

?>