<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/estados_casos.class.php");

$idEstadoAnterior = $_POST['idEstadoAnterior'];
$idEstadoNuevo = $_POST['idEstadoNuevo'];
$idUsuario = $_POST['idUsuario'];
$idSuperAdmin = 1;

$estadosCasos = new EstadosCasos();

//PRIMERO OBTENER CASOS
$casos = $estadosCasos->getEstadoCaso_ByUser_AndEstate($idUsuario, $idEstadoAnterior);

//Cambiar Estado
$valor = 'EDITADO MASIVAMENTE';

$resultado = array();

foreach ($casos AS $k=>$caso) {

	$edit_EstadoCaso = $estadosCasos->updateEstadoCaso_Estado($caso->id_caso, $idUsuario, $idEstadoAnterior, $idSuperAdmin, $idEstadoNuevo, $valor);

	if ($edit_EstadoCaso) {
		$resultado[] = array(
			'caso' 		=> $caso->id_caso,
			'resultado'	=> 'OK'
		);
	}
	else {
		$resultado[] = array(
			'caso' 		=> $caso->id_caso,
			'resultado'	=> 'ERROR'
		);
	}
}

echo json_encode($resultado);

?>