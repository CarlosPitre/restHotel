<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function guardar($datos = array())
	{
		$this->db->insert('usuarios', $datos);
		return true;
	}

	public function login($usuario,$contraseña)
	{
		$query=$this->db
					->select('usuarios.*')
					->from("usuarios")
					->where(array("usuario"=>$usuario,"contraseña"=>$contraseña))
					->get();
		return $query->result();
	}

	public function getMenu($perfil)
	{
		$query=$this->db
				->select("m.idMenu,m.descripcion,m.url")
				->from("menu m")
				->join("perfilesmenu pm","m.idMenu = pm.idMenu","inner")
				->join("perfiles p","pm.idPerfil = p.idPerfil","inner")
				->where(array("p.idPerfil" => $perfil))
				->order_by('m.descripcion', 'asc')
				->get();
		return $query->result();

	}

	public function getPerfilUsuario($usuario)
	{
		$consulta=array('usuario'=>$usuario);
		$query=$this->db
				->select('idPerfil')
				->from('usuarios')
				->where($consulta)
				->get();
		return $query->row();
	}

	public function getUsuarios()
	{
		$query=$this->db
				->select("u.usuario,u.estado,p.nombre")
				->from("usuarios u")
				->join("perfiles p","u.idPerfil = p.idPerfil","inner")
				->get();
		return $query->result();
	}

}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */