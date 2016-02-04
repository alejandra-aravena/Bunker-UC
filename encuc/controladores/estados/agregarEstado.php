<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/estados.class.php");

$estado = $_POST["estado"];
$desc=$_POST["desc"];
$vis=$_POST["vis"];

$estados = new Estados();

$addAccion = $estados->add_estado($estado, $desc, $vis);

if ($addAccion) {
	echo "ok";
}
else
	echo "error";

?>