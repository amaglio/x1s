<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividad_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
		
	}


	public function get_actividades()
	{
		$sql =  "  	SELECT *
	                FROM  actividad ta "  ;
    
	    $query = $this->db->query( $sql );

	    return $query->result_array();  
	}

	public function get_socio_actividad($id_socio)
	{
		$sql =  "  	SELECT 	sa.*, 
							esa.descripcion as descripcion_estado,
							act.descripcion as descripcion_actividad 
	                FROM socio_actividad sa,
	                	 estado_socio_actividad esa,
	                	 actividad act
	                WHERE id_socio = ? 
	                AND sa.id_estado_socio_actividad = esa.id_estado_socio_actividad
	                AND sa.id_actividad = act.id_actividad "  ;
    
	    $query = $this->db->query( $sql, array($id_socio ) );

	    return $query->result_array();  
	}

	public function get_cuotas_socio_actividad($id_socio_actividad)
	{
		$sql =  "  	SELECT *
	                FROM cuota sa 
	                WHERE id_socio_actividad = ?  "  ;
    
	    $query = $this->db->query( $sql, array($id_socio_actividad ) );

	    return $query->result_array();  
	}





}

/* End of file  */
/* Location: ./application/models/ */