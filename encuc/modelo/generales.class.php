<?php
require_once('modelo.php');

class Generales extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'generales';
		$this->singularName = 'general';
		$this->index = 'id_general';
		$this->columns = array('general', 'valor');
	}
	
	public function get_allGenerales() {
		return $this->select_all($this->table);
	}
	
	public function get_generalById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_generalByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_generalById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function add_general($general, $valor = NULL) {
		
		$values = array("'$general'", "'$valor'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_general($id, $general, $valor) {
		
		$values = array("'$general'", "'$valor'");
		
		return $this->update_row($this->table, $this->index, $id, $this->columns, $values);
	}
	
}
?>