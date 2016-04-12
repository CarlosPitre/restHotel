<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Habitaciones_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getHabitaciones($id=null)
	{
		if (! is_null($id)) {
			$query=$this->db
				->select('h.idHabitacion,h.numeroHabitacion,h.estadoHabitacion,c.descripcionCategoria as categoria,
						h.idCategoria as idCategoria,h.camas,h.piso,h.precio')
				->from('habitaciones h')
				->join('categorias c',"h.idCategoria = c.idCategoria","inner")
				->where("idHabitacion",$id)
				->get();
			if ($query->num_rows()==1) {
				return $query->row();
			}else{
				return null;
			}
			
		}else{
			$query=$this->db
				->select('h.idHabitacion,h.numeroHabitacion,h.estadoHabitacion,c.descripcionCategoria as categoria,h.idCategoria as idCategoria,h.camas,h.piso,h.precio')
				->from('habitaciones h')
				->join('categorias c',"h.idCategoria = c.idCategoria","inner")
				->order_by('numeroHabitacion ', 'asc')
				->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
			
		}
	}

	public function getCategorias($id=null)
	{
		if (! is_null($id)) {
			$query=$this->db
				->select('*')
				->from('categorias')
				->where("idCategoria",$id)
				->get();
			if ($query->num_rows()==1) {
				return $query->row();
			}else{
				return null;
			}
			
		}else{
			$query=$this->db
				->select('*')
				->from('categorias')
				->get();
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return null;
			}
			
		}
	}

	public function guardarCategoria($datos=array())
	{
		$this->db->insert('categorias', $datos);
		return true;
	}

	public function guardar($datos=array())
	{
		$this->db->insert('habitaciones', $datos);
		return true;
	}

}

/* End of file habitaciones_model.php */
/* Location: ./application/models/habitaciones_model.php */