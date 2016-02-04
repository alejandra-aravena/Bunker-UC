<?php
require_once("modelo.php");

class RolesUsuarios extends Modelo {
	
	protected $table;
	protected $index;
	protected $columns;
	protected $tizq;
	protected $tder;
	protected $indexIzq;
	protected $indexDer;
	protected $interes;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'roles_usuarios';
		$this->index = 'id_usuario';
		$this->columns = array('id_usuario', 'id_rol');
		$this->tizq = 'usuarios';
		$this->tder = 'roles';
		$this->indexIzq = 'id_usuario';
		$this->indexDer = 'id_rol';
		$this->interes = ',rol, usrname';
	}
	
	public function get_allRolesUsuarios() {
		return $this->join2tablas($this->tizq, $this->table , $this->tder, $this->indexIzq, $this->indexDer, $this->interes);
	}
	
	public function add_rol_usuario($id_usr, $id_rol) {
		$values = array($id_usr, $id_rol);
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	
	public function del_RolUsuarioByIds($idUsr, $idRol) {
		return $this->delete_by2Index($this->table, $this->indexIzq, $idUsr, $this->indexDer, $idRol);
	}
}
?>