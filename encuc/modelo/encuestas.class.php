<?php
require_once('modelo.php');

class Encuestas extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'encuestas';
		$this->singularName = 'encuesta';
		$this->index = 'id_encuesta';
		$this->columns = array('encuesta', 'limesurvey_encuesta');
	}
	
	public function get_allEncuestas() {
		return $this->select_all($this->table);
	}
	
	public function get_encuestaById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_encuestaByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_encuestaById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_encuestaByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_encuesta($encuesta, $limesurvey_encuesta) {
		
		$values = array("'$encuesta'", "'$limesurvey_encuesta'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_encuesta($id, $encuesta, $limesurvey_encuesta) {
		
		$values = array("'$encuesta'", "'$limesurvey_encuesta'");
		
		return $this->update_row($this->table, $this->index, $id, $this->columns, $values);
	}
	
}
?>