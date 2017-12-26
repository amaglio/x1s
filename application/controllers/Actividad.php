<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividad extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url'); 
		$this->load->library('grocery_CRUD');
	}
 

	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}

	public function index()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('actividad');
			$crud->set_subject('Tipos de actividad');

			$output = $crud->render();
			
			$this->load->view('estructura/head.php' );
 
			$this->load->view('example.php',(array)$output);
			//$this->load->view('estructura/footer');*/

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('socio'); 
			$crud->set_subject('Employee'); 
 
			$output = $crud->render();

			$this->_example_output($output);
	}


}