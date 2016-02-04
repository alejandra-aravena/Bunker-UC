<?php
require_once('modelo.php');

class Casos extends Modelo {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function get_allCasos() {
		return $this->select_all('casos');
	}
	
	public function getAllCasosWhitJoins() {
		$query = "SELECT * FROM listar_casos_usuario";
		
		return $this->queryArray($query);
	}
	public function getAllCasosWhitJoinsXEstado($idEstado) {
		$query = "SELECT * FROM listar_casos_usuario WHERE id_estado = ".$idEstado;
		
		return $this->queryArray($query);
	}
	
	public function getAllCasosWithAgenda() {
		$query = "SELECT * FROM listar_casos_activos";

		return $this->queryArray($query);
	}
	
	public function getAllCasosFueraServicio() {
		$query = "SELECT * FROM listar_casos_activos WHERE intentos_fservicio >= 3";

		return $this->queryArray($query);
	}
	public function getAllCasosIntentoLlamada() {
		$query = "SELECT * FROM listar_casos_activos WHERE intentos_llamada >= 10";

		return $this->queryArray($query);
	}
	
	public function getDetalleCaso($idCaso) {
		return $this->select_byId('casos', 'id_caso', $idCaso);
	}
	
	public function getAllCasosRepetidos() {
		return $this->select_all('casos_repetidos');
	}
	
	public function getDetalleCasoRepetido($idCasoRepetido) {
		return $this->select_byId('casos_repetidos', 'id_caso_repetido', $idCasoRepetido);
	}
	
	public function delCasoRepetidoById($idCasoRepetido) {
		return $this->delete_byId('casos_repetidos', 'id_caso_repetido', $idCasoRepetido);
	}
}
?>