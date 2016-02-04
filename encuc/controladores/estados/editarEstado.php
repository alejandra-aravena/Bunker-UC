<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados.class.php");

$id_estado=$_POST["id_estado"];
$estado=$_POST["estado"];
$desc=$_POST["desc"];
$vis=$_POST["vis"];

$estados = new Estados();

$editEstado = $estados->edit_estado($id_estado, $estado, $desc, $vis); 

if ($editEstado) {
	echo "ok";
}
else
	echo "error";

?>