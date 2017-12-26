<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('Login_model'); 
}

public function index()
{
	$datos['mensaje'] = $this->session->flashdata('mensaje');
	$datos['error'] = $this->session->flashdata('error');

	$this->load->view('login',$datos);
}

public function procesa_logueo()
{
	chrome_log("Login/procesa_login");
 
	if ($this->form_validation->run('loguearse') == FALSE):

		chrome_log("No paso validacion");
		$this->session->set_flashdata('mensaje', 'Error: no paso la validacion.');
		redirect('Login/index/','refresh');

	else: 
	 
		chrome_log("Paso validacion");

		if( $this->input->post("usuario") == 'x1s' &&  $this->input->post("clave") == 'x1s2018'  )
		{
			$this->session->set_userdata('usuario_x1s',  "x1s" );
			$this->session->set_flashdata('mensaje', 'Validacion exitosa');
			redirect('Home/index/','refresh');
		}
		else
		{

			$this->session->set_flashdata('mensaje', 'Error: usuario o clave incorrectos');
			redirect('Login/index/','refresh');
		}
 
	endif;	
}


public function logout()
{
	$this->session->unset_userdata('administrador_lemon');

	$this->db->close();
	session_destroy();
	redirect('Login/index/','refresh');
}



}