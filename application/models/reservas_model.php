<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getHabitacionesDisponibles($fechaEntrada=null,$fechaSalida=null)
	{
		/*
		$consulta = sprintf("r.fechaEntrada BETWEEN '%s' AND '%s'",$fechaEntrada,$fechaSalida);
		$query=$this->db
				->select('h.numeroHabitacion,h.estadoHabitacion,c.descripcion,h.camas,h.precioDia,h.precioNoche')
				->from('reservas r')
				->join('habitacionesreservas h', 'h.idReserva=r.idReserva','inner')
				->where($consulta)
				->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				return null;
			}
		*/
		$consulta = sprintf("r.fechaEntrada BETWEEN '%s' AND '%s'",$fechaEntrada,$fechaSalida);
		$query=$this->db
				->select('h.idHabitacion')
				->from('reservas r')
				->join('habitacionesreservas h', 'h.idReserva=r.idReserva','inner')
				->where($consulta)
				->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				return null;
			}
	}

	public function guardar($datos=array())
	{
		$this->db->insert('reservas', $datos);
		return $this->db->insert_id();
	}

	public function guardarHabitaciones($datos)
	{
		$this->db->insert('habitacionesreservas', $datos);
		return true;
	}

	public function getReservasClientesIn($cedula)
	{
		$query=$this->db
				//->select('r.idReserva,r.fechaEntrada,r.fechaSalida,r.estado,r.valorPago,c.abono')
				->select('*')
				->from('reservas r')
				//->join('check_in c','c.idReserva = r.idReserva','inner')
				->where(array('idCliente' => $cedula))
				->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				return null;
			}
	}

	public function getReservasClientes($cedula)
	{
		$query=$this->db
				->select('r.idReserva,r.fechaEntrada,r.fechaSalida,r.estado,r.valorPago')
				->from('reservas r')
				->where(array('idCliente' => $cedula))
				->order_by('r.idReserva','desc')
				//->limit('3','0')
				->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				return null;
			}
	}

	public function getReservasHabitaciones($idReserva)		
	{
		$query=$this->db
				->select('h.numeroHabitacion,h.camas,h.piso, h.precio,c.descripcionCategoria')
				->from('habitaciones h')
				->join('habitacionesreservas hr','h.numeroHabitacion = hr.idHabitacion','inner')
				->join('categorias c','c.idCategoria = h.idCategoria','inner')
				->where(array('hr.idReserva' => $idReserva))
				->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				return null;
			}
	}

	public function guardarCheckIn($datos=array())
	{
		$this->db->insert('check_in', $datos);
		return true;
	}
	public function guardarCheckOut($datos=array())
	{
		$this->db->insert('check_out', $datos);
		return true;
	}
	public function guardarAcompanante($datos = array())
	{
		$this->db->insert('acompanantes', $datos);
		return true;
	}


}

/* End of file reservas_model.php */
/* Location: ./application/models/reservas_model.php */