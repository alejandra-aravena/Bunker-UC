<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_visibilidad.class.php");

$columna=$_POST["columna"];
$vis=$_POST["visibilidad"];

$columnaVisibilidad = new ColumnasVisibilidad();

$editColumnaVisibilidad = $columnaVisibilidad->edit_visibilidadColumna($columna, $vis);

if ($editColumnaVisibilidad) {
	echo "ok";
}
else
	echo "error";

?>