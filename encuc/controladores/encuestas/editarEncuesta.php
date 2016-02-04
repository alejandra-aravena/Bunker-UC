<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/encuestas.class.php");

$id_encuesta=$_POST["id_encuesta"];
$encuesta=$_POST["encuesta"];
$link_str=$_POST["link_str"];

$encuestas = new Encuestas();

$editEncuesta = $encuestas->edit_encuesta($id_encuesta, $encuesta, $link_str); 

if ($editEncuesta) {
	echo "ok";
}
else
	echo "error";

?>