<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socio extends CI_Controller 
{

	public function __construct()
	{
		
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Socio_model');
		$this->load->model('Actividad_model');
	}
	
	public function index()
	{
	 	$data['mensaje'] = $this->session->flashdata('mensaje');
		$data['socios'] =  $this->Socio_model->get_socios(); 

		$data['tipo_actividad'] =  $this->Actividad_model->get_actividades();

	 	$this->load->view('estructura/head.php' );
		$this->load->view('socio/index_socios.php',$data );
		$this->load->view('estructura/footer');
	} 

	public function ver_socio($id_socio)
	{	
		chrome_log("ver_socio");

		$_POST['id_socio'] = $id_socio;
		$this->form_validation->set_data($_POST);
		$this->form_validation->set_message('existe_socio_validation', 'El usuario no existe');	
		
		if ($this->form_validation->run('ver_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error el socio no existe');
			redirect('socio','refresh');	

		else:

			$data['mensaje'] = $this->session->flashdata('mensaje');
			$data['datos_socio'] =  $this->Socio_model->get_datos_socio(  $id_socio ); 
			$data['emails_socio'] =  $this->Socio_model->get_emails_socio(  $id_socio ); 
			$data['telefonos_socio'] =  $this->Socio_model->get_telefonos_socio(  $id_socio ); 
			$data['actividades'] =  $this->Actividad_model->get_actividades();

			$socio_actividad =  $this->Actividad_model->get_socio_actividad( $id_socio);

			$array_actividades = array();

			foreach ($socio_actividad as $row) 
			{
				$info['actividades_socio'] = $row;
				$info['cuotas_actividades'] =  $this->Actividad_model->get_cuotas_socio_actividad($row['id_socio_actividad']);

				array_push($array_actividades, $info);
			}

			$data['actividades_socio'] = $array_actividades;

	 		$this->load->view('estructura/head.php' );
			$this->load->view('socio/ver_socio.php',$data );
			$this->load->view('estructura/footer');

		endif;

	 
	}  

	public function alta_socio()
	{
		chrome_log("alta_socio");
		
		if ($this->form_validation->run('alta_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la alta socio.');
			redirect('socio','refresh');	

		else:

			chrome_log("Paso validacion");


			// Archivo fotos usuario

			$config['upload_path'] = 'assets/images/fotos_socios/'; // Carpeta donde guarda las fotos
			$config['allowed_types'] = 'jpg|jpeg|png'; 	// set the filter image types

			$config['file_name'] = time();

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->set_allowed_types('*');
		 	
		 	if (!$this->upload->do_upload('foto')):

		 		chrome_log("No subio la foto al servidor");
		 		$nombre_archivo = NULL;

		 	else:

		 		chrome_log("Si subio la foto al servidor");
		 		$datos= $this->upload->data(); 
				$nombre_archivo = $datos['file_name'];


		 	endif;

		 	$_POST['foto'] = $nombre_archivo;
 
			$result = $this->Socio_model->abm_socio( 'A', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Socio creado exitosamente');
				chrome_log("Programa agregado");
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo agregar el socio, intentelo nuevamente mas tarde');
			}  
			 
		endif;

		redirect('socio','refresh');
	}

	public function modifica_socio()
	{
		chrome_log("modifica_socio");
		
		if ($this->form_validation->run('modifica_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la modifica socio.');
			redirect('socio','refresh');	

		else:

			chrome_log("Paso validacion"); 

			if( !empty($_FILES['foto']['name'])):
  

				$config['upload_path'] = 'assets/images/fotos_socios/'; // Carpeta donde guarda las fotos
				$config['allowed_types'] = 'jpg|jpeg|png'; 	// set the filter image types

				$config['file_name'] = time();

				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$this->upload->set_allowed_types('*');
			 	
			 	if (!$this->upload->do_upload('foto')):

			 		chrome_log("No subio la foto al servidor");
			 		$nombre_archivo = NULL;

			 	else:

			 		chrome_log("Si subio la foto al servidor");
			 		$datos= $this->upload->data(); 
					$nombre_archivo = $datos['file_name'];


			 	endif;

			 	$_POST['foto'] = $nombre_archivo;  

			 	if($this->input->post('foto_anterior') != 'avatar.jpg') // Borro el archivo si no es el avatar
			 	{
			 		$archivo_borrar = 'assets/images/fotos_socios/'.$this->input->post('foto_anterior');
			 		unlink($archivo_borrar);
			 	}

		 	endif;

		 	
			$result = $this->Socio_model->abm_socio( 'M', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Socio modificado exitosamente');
				chrome_log("Socio modificado");
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo modificar el socio, intentelo nuevamente mas tarde');
			}  
			 
		endif;

		redirect('socio/ver_socio/'.$this->input->post('id_socio'),'refresh');
	}

	public function alta_email_socio()
	{
		chrome_log("alta_email_socio");
		
		if ($this->form_validation->run('alta_email_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la alta de email.');
			redirect('socio','refresh');	

		else:

			chrome_log("Paso validacion");

			$result = $this->Socio_model->abm_email( 'A', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Se agregó el email exitosamente');
				chrome_log("Programa agregado");
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo agregar el email, intentelo nuevamente mas tarde');
			}  
			 
		endif;

		redirect('socio/ver_socio/'.$this->input->post('id_socio'),'refresh');
	}

	public function baja_email_socio()
	{
		chrome_log("baja_email_socio");
		
		if ($this->form_validation->run('baja_email_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la baja de email.');
			$return["error"] = TRUE;

		else:

			chrome_log("Paso validacion");

			$result = $this->Socio_model->abm_email( 'B', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Se eliminó el email exitosamente');
				chrome_log("email");
				$return["error"] = FALSE;
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo eliminar el email, intentelo nuevamente mas tarde');
				$return["error"] = TRUE;
			}  
			 
		endif;

		print json_encode($return); 
	}

	public function baja_telefono_socio()
	{
		chrome_log("baja_telefono_socio");
		
		if ($this->form_validation->run('baja_telefono_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la baja de telefono.');
			$return["error"] = TRUE;

		else:

			chrome_log("Paso validacion");

			$result = $this->Socio_model->abm_telefono( 'B', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Se eliminó el telefono exitosamente');
				chrome_log("telefono");
				$return["error"] = FALSE;
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo eliminar el telefono, intentelo nuevamente mas tarde');
				$return["error"] = TRUE;
			}  
			 
		endif;

		print json_encode($return); 
	}

	public function alta_telefono_socio()
	{
		chrome_log("alta_telefono_socio");
		
		if ($this->form_validation->run('alta_telefono_socio') == FALSE):

			chrome_log("No paso validacion");
			$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> Error: no paso la alta de telefono.');
			redirect('socio','refresh');	

		else:

			chrome_log("Paso validacion");

			$result = $this->Socio_model->abm_telefono( 'A', $this->input->post() ); 
		 
			if($result != FALSE)
			{	
				$this->session->set_flashdata('mensaje', '<i class="fa fa-check" aria-hidden="true"></i> Se agregó el telefono exitosamente');
				chrome_log("Programa agregado");
	 
			}
			else
			{	
				chrome_log("No Inserto");
				$this->session->set_flashdata('mensaje', '<i class="fa fa-times" aria-hidden="true"></i> No se pudo agregar el telefono, intentelo nuevamente mas tarde');
			}  
			 
		endif;

		redirect('socio/ver_socio/'.$this->input->post('id_socio'),'refresh');
	}

	// ----> VALIDAN FORM VALIDATION --->

	public function existe_socio_validation($id_socio=null)
	{
		if($this->Socio_model->existe_socio($id_socio)) 
			return true; 
		else 
			return false; // Duplicado
	}
}
