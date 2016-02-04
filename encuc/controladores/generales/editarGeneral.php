<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/generales.class.php");

$id_general=$_POST["id_general"];
$general=$_POST["general"];
$valor=$_POST["valor"];

$generales = new Generales();

$editGeneral = $generales->edit_general($id_general, $general, $valor); 

if ($editGeneral) {
	echo "ok";
}
else
	echo "error";

?>