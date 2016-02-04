<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados.class.php");

$id_estado=$_POST["id_estado"];

$estados = new Estados();

$delEstado = $estados->del_estadoById($id_estado);

if ($delEstado) {
	echo "ok";
}
else
	echo "error";

?>