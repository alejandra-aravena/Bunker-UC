<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/generales.class.php");

$general = $_POST["general"];
$valor=$_POST["valor"];

$generales = new Generales();

$addGeneral = $generales->add_general($general, $valor);

if ($addGeneral) {
	echo "ok";
}
else
	echo "error";

?>