<?php
require_once('modelo.php');

class EncuestasCasos extends Modelo {
	
	protected $table;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'encuestas_casos';
		$this->index = 'id_caso';
		$this->columns = array('id_caso', 'id_encuesta');
	}
	
	public function getAllEncuestasCasosWhitJoins() {
		$query = 'SELECT * FROM encuestas_casos a 
					LEFT JOIN casos b ON b.id_caso = a.id_caso
					LEFT JOIN encuestas c ON c.id_encuesta = a.id_encuesta';
		
		return $this->queryArray($query);
	}
	public function getAllEncuestasSinCasos() {
		$query = 'SELECT b.* FROM casos b 
					LEFT JOIN encuestas_casos a ON b.id_caso = a.id_caso
					LEFT JOIN encuestas c ON c.id_encuesta = a.id_encuesta
					WHERE a.id_encuesta IS NULL';
		
		return $this->queryArray($query);
	}
	public function getIdEncuestasCasosWhitJoins($idEncuesta) {
		$query = 'SELECT * FROM encuestas_casos a 
					LEFT JOIN casos b ON b.id_caso = a.id_caso
					LEFT JOIN encuestas c ON c.id_encuesta = a.id_encuesta
					WHERE a.id_encuesta = '.$idEncuesta;
		
		return $this->queryArray($query);
	}
	
	public function getEncuestaByCaso($idCaso) {
		return $this->select_byColumnName($this->table, $this->index, $idCaso);
	}
	
	public function add_encuesta_caso($idCaso, $idEncuesta) {
		$values = array($idCaso, $idEncuesta);
		return $this->insert_row($this->table, $this->columns, $values);
	}
	public function edit_encuesta_caso($idCaso, $idEncuesta) {
		return $this->update_column_of_row($this->table, $this->index, $idCaso, 'id_encuesta', $idEncuesta);
	}
}
?>