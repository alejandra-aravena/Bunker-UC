<?php
require_once('modelo.php');

class EstadosCasos extends Modelo {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function getAllEstadosCasosWhitJoins() {
		$query = "SELECT * FROM listar_estados_casos";
		
		return $this->queryArray($query);
	}
	
	public function getAllEstadosCasosWhitJoinsByIdCaso($idCaso) {
		$query = "SELECT * FROM listar_estados_casos WHERE id_caso = ".$idCaso." ORDER BY update_date DESC";
		
		return $this->queryArray($query);
	}
	
	public function getEstadoCaso_ByUser_AndEstate($idUsuaro, $idEstado) {
		$query = "SELECT * FROM estados_casos WHERE id_usuario = ".$idUsuaro." AND id_estado = ".$idEstado;
		
		return $this->queryArray($query);
	}
	
	public function addEstadoCasoInicial($id_caso) {
		$query = 'INSERT INTO estados_casos (id_caso, id_estado, id_usuario, valor, agenda) VALUES ('.$id_caso.', 1, 1, "Inicial", "0000-00-00 00:00:00")';
		
		return $this->queryBool($query);
	}
	public function addEstadoCaso($id_caso, $id_estado, $id_usuario, $valor, $agenda, $limeSurvey = NULL, $cdr = NULL ) {
		
		$query = 'INSERT INTO estados_casos (id_caso, id_estado, id_usuario, valor, agenda, limesurvey_caso, cdr_caso) VALUES ('.$id_caso.', '.$id_estado.', '.$id_usuario.', "'.$valor.'", "'.$agenda.'", "'.$limeSurvey.'", "'.$cdr.'")';
		
		return $this->queryBool($query);
	}
	
	public function updateEstadoCaso_Estado($idCaso, $idUsuario, $idEstado, $idNuevoUsuario, $idNuevoEstado, $valor) {
		$query = "UPDATE estados_casos SET id_estado = ".$idNuevoEstado.", id_usuario = ".$idNuevoUsuario.", valor = '".$valor."', update_date = NOW() WHERE id_usuario = ".$idUsuaro." AND id_estado = ".$idEstado." AND id_caso = ".$idCaso;
		
		return $this->queryBool($query);
	}
	
	public function sumarFueraDeServicio($idCaso) {
		$query = "UPDATE casos SET intentos_fservicio=intentos_fservicio+1 WHERE id_caso = ".$idCaso;
		return $this->queryBool($query);
	}
	public function sumarIntentoLlamada($idCaso) {
		$query = "UPDATE casos SET intentos_llamada=intentos_llamada+1 WHERE id_caso = ".$idCaso;
		return $this->queryBool($query);
	}
}
?>
