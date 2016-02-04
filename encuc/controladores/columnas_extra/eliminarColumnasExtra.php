<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_extra.class.php");

$id_columna=$_POST["id_columna"];

$Columnas = new Columnas();

$delColumnas = $Columnas->del_columnaById($id_columna);

if ($delColumnas) {
	echo "ok";
}
else
	echo "error";

?>