<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/encuestas.class.php");

$encuesta = $_POST["encuesta"];
$link_str=$_POST["link_str"];

$encuestas = new Encuestas();

$addEncuesta = $encuestas->add_encuesta($encuesta, $link_str);

if ($addEncuesta) {
	echo "ok";
}
else
	echo "error";

?>