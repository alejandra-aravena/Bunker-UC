<?php
require_once('modelo.php');

class Roles extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'roles';
		$this->singularName = 'rol';
		$this->index = 'id_rol';
		$this->columns = array('rol');
	}
	
	public function get_allRoles() {
		return $this->select_all($this->table);
	}
	
	public function get_rolById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_rolByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_rolById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_rolByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_rol($rol) {
		
		$values = array("'$rol'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_rol($id, $rol) {
		
		$values = array("'$rol'");
		
		return $this->update_row($this->table, $this->index, $id, $this->columns, $values);
	}
	
}
?>