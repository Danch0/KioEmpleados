<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Empleados
 *
 * Este modelo representa las tablas de Empleados
 *
 */
class M_empleados extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function empleadoJefe()
	{
		$this->db->select('ctrl_empleados.E_ID_ROL, ctrl_empleados.E_ID_EMPLEADO, ctrl_empleados.T_NOMBRE');
		$this->db->from('ctrl_empleados');
		$this->db->from('cat_roles');
		$this->db->where('cat_roles.E_ID_ROL', 1);
		$this->db->where('ctrl_empleados.E_ID_ROL = cat_roles.E_ID_ROL');
		if($query = $this->db->get()){
			if($query->num_rows() > 0){
					return $query->result();
			}
		} else {
			return FALSE;
		}
		return FALSE;
	}

	function get_tabla_t07()
	{
		if($query = $this->db->get('KIO_T07_CAT_PROYECTOS')){
			if($query->num_rows() > 0){
					return $query->result();
			}
		} else {
			return FALSE;
		}
		return FALSE;

	}
}