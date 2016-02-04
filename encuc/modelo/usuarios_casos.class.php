<?php
require_once('modelo.php');

class UsusariosCasos extends Modelo {
	
	protected $table;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'casos_usuarios';
		$this->index = 'id_caso';
		$this->columns = array('id_caso', 'id_usuario');
	}
	
	public function getAllUsuarioCasosWhitJoins() {
		$query = 'SELECT * FROM casos_usuarios a 
					LEFT JOIN casos b ON b.id_caso = a.id_caso
					LEFT JOIN usuarios c ON c.id_usuario = a.id_usuario';
		
		return $this->queryArray($query);
	}
	public function getAllUsuarioCasosByIdUsuario($idUsuario) {
		$query = 'SELECT * FROM casos_usuarios a 
					LEFT JOIN casos b ON b.id_caso = a.id_caso
					LEFT JOIN usuarios c ON c.id_usuario = a.id_usuario
					WHERE a.id_usuario = '.$idUsuario;
		
		return $this->queryArray($query);
	}
	public function getAllUsuarioSinCasoso() {
		$query = 'SELECT b.*, c.* FROM casos b  
					LEFT JOIN casos_usuarios a ON b.id_caso = a.id_caso
					LEFT JOIN usuarios c ON c.id_usuario = a.id_usuario
					WHERE a.id_usuario IS NULL';
		
		return $this->queryArray($query);
	}
	public function getIdUsuarioCasosWhitJoins($idUsuario) {
		$query = "SELECT * FROM listar_usuarios_casos WHERE id_usuario = ".$idUsuario;
				
		
		return $this->queryArray($query);
	}
	
	public function getIdUsuarioCasosAGENDAWhitJoins($idUsuario) {
		$query = "SELECT * FROM listar_usuarios_casos WHERE intentos_llamada < 10 AND intentos_fservicio < 3 AND id_usuario = ".$idUsuario;
				
		
		return $this->queryArray($query);
	}
	
	public function getIdUsuarioCasosNORMALWhitJoins($idUsuario) {
		$query = "SELECT * FROM listar_usuarios_casos WHERE intentos_llamada < 10 AND intentos_fservicio < 3 AND id_usuario = ".$idUsuario;
		
		return $this->queryArray($query);
	}
	
	public function getByIdCaso($idCaso) {
		return $this->select_byId($this->table, $this->index, $idCaso);
	}
	
	public function add_usuario_caso($idCaso, $idUsuario) {
		$values = array($idCaso, $idUsuario);
		return $this->insert_row($this->table, $this->columns, $values);
	}
	public function edit_usuario_caso($idCaso, $idUsuario) {
		return $this->update_1columnOfrow($this->table, $this->index, $idCaso, "id_usuario", $idUsuario);
	}
}
?>