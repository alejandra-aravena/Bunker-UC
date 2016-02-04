<?php
require_once('modelo.php');

class Acciones extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'acciones';
		$this->singularName = 'accion';
		$this->index = 'id_accion';
		$this->columns = array('accion');
	}
	
	public function get_allAcciones() {
		return $this->select_all($this->table);
	}
	
	public function get_accionById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_accionByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_accionById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_accionByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_accion($accion) {
		
		$values = array("'$accion'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_accion($id, $accion) {
		
		$values = array("'$accion'");
		
		return $this->update_row($this->table, $this->index, $id, $this->columns, $values);
	}
	
}
?>