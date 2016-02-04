<?php
require_once("modelo.php");

class Usuarios extends Modelo {
	
	protected $table;
	protected $singularName;
	protected $index;
	protected $columns;
	protected $columnsXupdate;
	
	public function __construct() {
		parent::__construct();
		
		$this->table = 'usuarios';
		$this->singularName = 'usrname';
		$this->index = 'id_usuario';
		$this->columns = array('usrname', 'password','ip_estacion', 'num_cdr');
		$this->columnsXupdate = array('usrname','ip_estacion', 'num_cdr');
	}
	
	public function get_allUsuarios() {
		return $this->select_all($this->table);
	}
	public function get_allEstaciones() {
		return $this->select_withFilter($this->table, 'ip_estacion', ' AND ip_estacion != ""', 'IS NOT NULL');
	}
	
	public function get_usuarioById($id) {
		return $this->select_byId($this->table, $this->index, $id);
	}
	
	public function get_usuarioByName($name) {
		return $this->select_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function del_usuarioById($id) {
		return $this->delete_byId($this->table, $this->index, $id);
	}
	
	public function del_usuarioByName($name) {
		return $this->delete_byColumnName($this->table, $this->singularName, $name);
	}
	
	public function add_usuario($usrname, $password, $ipEstacion, $numCdr) {
		
		$values = array("'$usrname'", "'$password'","'$ipEstacion'", "'$numCdr'");
		
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function edit_usuario($id, $usrname, $ipEstacion, $numCdr) {
		$values = array("'$usrname'","'$ipEstacion'", "'$numCdr'");
		return $this->update_row($this->table, $this->index, $id, $this->columnsXupdate, $values);
	}
	
	public function datosUsuario($usrname) {
		return $this->get_usuarioByName($usrname);
	}
	
	public function cambiarPassword($id, $newPassword) {
		return $this->update_column_of_row($this->table, $this->index, $id, 'password', "'$newPassword'");
	}
	
	public function get_EstacionByIdUsuer ($idUsuario) {
		$sql = "SELECT * FROM usuarios u
			LEFT JOIN roles_usuarios ru ON ru.id_usuario = u.id_usuario
			WHERE u.id_usuario = ".$idUsuario." AND ru.id_rol = 7";
			
			return $this->queryBool($sql);
	}
	public function get_RolesByIdUsuer ($idUsuario) {
		$sql = "SELECT id_rol FROM usuarios u
			LEFT JOIN roles_usuarios ru ON ru.id_usuario = u.id_usuario
			WHERE u.id_usuario = ".$idUsuario;
			$res = $this->queryArray($sql);
			
			$roles = array();
			foreach ($res AS $k=>$idRol) {
				$roles[] = $idRol->id_rol;
			}
			
			return $roles;
	}
	
}
?>