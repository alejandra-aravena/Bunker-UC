<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/generales.class.php");

$generales = new Generales();

$arrayGenerales = $generales->get_allGenerales();

echo json_encode ($arrayGenerales);

?>