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
$agenda = '0000-00-00 00:00:00';
$valor = 'AGREGADO MASIVAMENTE';

$resultado = array();

foreach ($casos AS $k=>$caso) {
	
	$add_EstadoCaso = $estadosCasos->addEstadoCaso($caso->id_caso, $idEstadoNuevo, $idSuperAdmin, $valor, $agenda);

	if ($add_EstadoCaso) {
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