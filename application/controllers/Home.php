<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct()
	{
		
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Administrador_model');

	}

	 
	public function index()
	{
	 	$data['mensaje'] = $this->session->flashdata('mensaje');

	 	$this->load->view('/estructura/head' );
		$this->load->view('/home/index',$data );
		$this->load->view('/estructura/footer');
	} 

	




}
