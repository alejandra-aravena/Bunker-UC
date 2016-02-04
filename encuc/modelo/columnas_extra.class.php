<?php
require_once('modelo.php');

class Columnas extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'columnas_extra';
		$this->singularName = 'columna';
		$this->index = 'id_columna';
		$this->columns = array('columna');
	}
	
	public function get_allColumnas() {
		return $this->select_all($this->table);
	}
	
	public function get_columnaById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_columnaByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_columnaById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_columnaByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_columna($columna) {
		
		$values = array("'$columna'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_columna($id, $columna) {
		
		return $this->update_column_of_row($this->table, $this->index, $id, $this->singularName, "'$columna'");
	}
	
}
?>