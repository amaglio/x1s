<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socio_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
		
	}


	public function get_socios()
	{
		$sql =  "  	SELECT *
	                FROM socio s "  ;
    
	    $query = $this->db->query( $sql );

	    return $query->result_array();  
	}

	public function get_datos_socio($id_socio)
	{
		$sql =  "  	SELECT *
	                FROM socio s
	                WHERE id_socio = ? "  ;
    
	    $query = $this->db->query( $sql, array($id_socio) );

	    return $query->row();  
	}

	public function get_emails_socio($id_socio)
	{
		$sql =  "  	SELECT *
	                FROM socio_email se
	                WHERE se.id_socio = ? "  ;
    
	    $query = $this->db->query( $sql, array($id_socio) );

	    return $query->result_array();  
	}

	public function set_email_socio($array)
	{
		$sql =  "  INSERT INTO socio_email (id_socio, email )
	               VALUES (? , ? ) "  ;
    
	    $query = $this->db->query( $sql, array($array['id_socio'], $array['email']) );

	    return $this->db->affected_rows();
	}


	public function get_telefonos_socio($id_socio)
	{
		$sql =  "  	SELECT *
	                FROM socio_telefono st
	                WHERE st.id_socio = ? "  ;
    
	    $query = $this->db->query( $sql, array($id_socio) );

	    return $query->result_array();  
	}


	public function abm_socio($accion, $array)
	{

	  switch ($accion):
	  
	    case 'A': 
	        
	        $this->db->trans_start();

		        $socio =  array();
		        $socio['nombre'] = $array['nombre'];
		        $socio['apellido'] = $array['apellido']; 
		        $socio['fecha_nacimiento'] = $array['fecha_nacimiento']; 

		        if(isset( $array['foto']))
		        	$socio['foto'] = $array['foto']; 

		        $this->db->insert('socio', $socio); 

		        $id_socio = $this->db->insert_id(); 

		        // Socio - Actividad

		        $socio_actividad =  array();
		        $socio_actividad['id_socio'] = $id_socio;
		        $socio_actividad['id_actividad'] = $array['id_actividad']; 
				$socio_actividad['id_estado_socio_actividad'] = ESTADO_ACTIVO;
	 
		        $this->db->insert('socio_actividad', $socio_actividad); 

		    $this->db->trans_complete();


		    if ($this->db->trans_status() !== FALSE)
			{
			     return TRUE;
			}


	        break;
	    
	    case 'M':
 

 			$this->db->trans_start();

				$array_where = array( 'id_socio' => $array['id_socio'] );

				$socio =  array();
				$socio['nombre'] = $array['nombre'];
				$socio['apellido'] = $array['apellido']; 
				$socio['fecha_nacimiento'] = $array['fecha_nacimiento']; 

				 
				if(isset( $array['foto'])){ 
		        	$socio['foto'] = $array['foto'];  
		        } 

				$this->db->where($array_where);
				$this->db->update('socio', $socio); 

			$this->db->trans_complete();

			if ($this->db->trans_status() !== FALSE)
			{
			     return TRUE;
			}


			break;

	    case 'B':
	      
	      $this->db->where('id_socio', $array['id_socio']);
	      $this->db->delete('socio'); 


	      break;
	  
	  endswitch;


	  return $this->db->affected_rows();
	}


	public function abm_email($accion, $array)
	{

	  switch ($accion):
	  
	    case 'A': 
	        
	        // Socio 

	        $email_socio =  array();
	        $email_socio['id_socio'] = $array['id_socio'];
	        $email_socio['email'] = $array['email']; 

	        if(isset($array['responsable']))
	        	$email_socio['responsable'] = $array['responsable']; 

	        $this->db->insert('socio_email', $email_socio); 

	        break;
	    
	    case 'M':

			$array_where = array( 'id_email' => $array['id_email'] );

			$socio_email =  array();
			$socio_email['id_socio'] = $array['id_socio'];
			$socio_email['email'] = $array['email'];   

			 if(isset($array['responsable']))
	        	$email_socio['responsable'] = $array['responsable']; 

			$this->db->where($array_where);
			$this->db->update('socio_email', $socio_email); 

			break;

	    case 'B':
	      
	      $this->db->where('id_email', $array['id_email']);
	      $this->db->delete('socio_email'); 


	      break;
	  
	  endswitch;


	  return $this->db->affected_rows();
	}


	public function abm_telefono($accion, $array)
	{

	  switch ($accion):
	  
	    case 'A': 
	        
	        $telefono_socio =  array();
	        $telefono_socio['id_socio'] = $array['id_socio'];
	        $telefono_socio['telefono'] = $array['telefono']; 

	        if(isset($array['responsable']))
	        	$telefono_socio['responsable'] = $array['responsable']; 

	        $this->db->insert('socio_telefono', $telefono_socio); 

	        break;
	    
	    case 'M':

			$array_where = array( 'id_telefono' => $array['id_telefono'] );

			$socio_telefono =  array();
			$socio_telefono['id_socio'] = $array['id_socio'];
			$socio_telefono['telefono'] = $array['telefono'];   

			 if(isset($array['responsable']))
	        	$telefono_socio['responsable'] = $array['responsable']; 

			$this->db->where($array_where);
			$this->db->update('socio_telefono', $socio_telefono); 

			break;

	    case 'B':
	      
	      $this->db->where('id_telefono', $array['id_telefono']);
	      $this->db->delete('socio_telefono'); 


	      break;
	  
	  endswitch;


	  return $this->db->affected_rows();
	}

	function existe_socio($id_socio)
	{
	    chrome_log("Socio_model/existe_usuario");
	    
	    $sql = "    SELECT *
	                FROM socio
	                where id_socio = ? " ;
	 
	    $query = $this->db->query($sql, array($id_socio));

	    if(  $query->num_rows() > 0 )
	    	return true;
	    else
	    	return false;

	}
 



}

/* End of file  */
/* Location: ./application/models/ */