<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function guardar($datos=array())
	{
		$this->db->insert('clientes', $datos);
		return true;
	}

	public function getCliente($cedula=null)
	{
		if (! is_null($cedula)) {
			$query=$this->db
				->select('*')
				->from('clientes')
				->where("cedula",$cedula)
				->where("estado","Activo")
				->get();
			if ($query->num_rows()==1) {
				return $query->row();
			}else{
				return null;
			}
			
		}else{
			$query=$this->db
				->select('*')
				->from('clientes')
				->where("estado","Activo")
				->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
			
		}
	}
	public function update($datos = array(), $id)
	{
		$this->db->where('cedula', $id);
		$this->db->update('clientes', $datos);
		return true;
	}

	public function eliminar($datos=array(),$id)
	{
		$this->db->where('cedula', $id);
		$this->db->update('clientes', $datos);
		return true;
	}

	public function getDepartamentos()
	{
		$query=$this->db
			->select('*')
			->from('departamento')
			->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}
	public function getMunicipios($idDepartamento)
	{
		$query=$this->db
			->select('*')
			->from('municipio')
			->where('idDepartamento',$idDepartamento)
			->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return null;
		}
	}
}

/* End of file clientes_model.php */
/* Location: ./application/models/clientes_model.php */