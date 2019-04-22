<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller{

  public function __construct()
  {
    parent::__construct();

    if ( ! $this->ion_auth->logged_in() || ! $this->ion_auth->is_admin())
		{
			// redirect them to the login page
			redirect('/admin/login', 'refresh');
		}
    $this->load->library('grocery_CRUD');
    $this->load->model('crud/grocery_crud_model');
  }

  function index()
  {
    $crud = new grocery_CRUD();

    $crud->set_table('users');
    $crud->set_theme('datatables');
    $crud->set_subject('Usere');

    //Change field from textarea to input

  // $crud->unset_texteditor('page_link','page_meta_description');
    $crud->unset_columns(array('password','salt','ip_address','activation_code','created_on','remember_code','forgotten_password_code','forgotten_password_time'));


    $output = $crud->render();
    $output->title = "Users";
    $this->load->view('templates/header', $output);
    $this->load->view('pages/pages');
    //$this->_example_output($output);
    $this->load->view('templates/footer');
  }

}
