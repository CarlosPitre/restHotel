<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfiles_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getMenu()
	{
		$query=$this->db
				->select('*')
				->from('menu')
				->get();
		return $query->result();
	}

	
	public function getPerfiles($id=null)
	{
		if (! is_null($id)) {
			$query=$this->db
				->select('*')
				->from('perfiles')
				->where("idPerfil",$id)
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
				->from('perfiles')
				->where("estado","Activo")
				->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
			
		}
	}

	public function guardar($datos = array())
	{
		$this->db->insert('perfiles', $datos);
		return $this->db->insert_id();
	}

	public function guardarMenu($datos = array())
	{
		$this->db->insert('perfilesmenu', $datos);
		return true;	
	}

	public function getPerfilNombre($perfil)
	{
		$query=$this->db
				->select('*')
				->from('perfiles')
				->where(array('nombre' => $perfil))
				->get();
		return $query->row();
	}

	public function getPerfilId($idPerfil)
	{
		$query=$this->db
				->select('*')
				->from('perfiles')
				->where(array('idPerfil' => $idPerfil))
				->get();
		return $query->row();
	}

	public function eliminar($idperfil)
	{
		$this->db->where('idPerfil', $idperfil);
		$this->db->delete('perfiles');
		return true;
	}

	public function update($datos=array(),$idPerfil)		
	{
		$this->db->where('idPerfil', $idPerfil);
		$this->db->update('perfiles', $datos);
		return true;
	}

}

/* End of file perfiles_model.php */
/* Location: ./application/models/perfiles_model.php */