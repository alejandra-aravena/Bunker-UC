<?php
require_once("modelo.php");

class EstadosAcciones extends Modelo {
	
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
		
		$this->table = 'estados_acciones';
		$this->index = 'id_estado';
		$this->columns = array('id_estado', 'id_accion', 'prioridad');
		$this->tizq = 'estados';
		$this->tder = 'acciones';
		$this->indexIzq = 'id_estado';
		$this->indexDer = 'id_accion';
		$this->interes = ',estado, accion, prioridad';
	}
	
	public function get_allEstadosAcciones() {
		return $this->join2tablas($this->tizq, $this->table , $this->tder, $this->indexIzq, $this->indexDer, $this->interes);
	}
	
	public function add_estado_accion($idEstado, $idAccion, $prioridad) {
		$values = array($idEstado, $idAccion, $prioridad);
		return $this->insert_row($this->table, $this->columns, $values);
	}
	
	public function del_EstadoAccionByIds($idEstado, $idAccion) {
		return $this->delete_by2Index($this->table, $this->indexIzq, $idEstado, $this->indexDer, $idAccion);
	}
	
}
?>