<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/generales.class.php");

$general=$_POST["general"];

$generales = new Generales();

$getGeneral = $generales->get_generalByName($general); 

echo $getGeneral->valor;

?>