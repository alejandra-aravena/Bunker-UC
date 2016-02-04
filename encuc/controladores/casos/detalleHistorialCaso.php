<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_casos.class.php");

$idCaso = $_POST['idCaso'];

$casos = new EstadosCasos();

$detalle = $casos->getAllEstadosCasosWhitJoinsByIdCaso($idCaso);

echo json_encode ($detalle);

?>