<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/generales.class.php");

$id_general=$_POST["id_general"];

$generales = new Generales();

$delGeneral = $generales->del_generalById($id_general);

if ($delGeneral) {
	echo "ok";
}
else
	echo "error";

?>