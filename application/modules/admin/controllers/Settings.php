<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller{

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

  //general
  function index()
  {
    redirect(base_url('admin/settings/general'));
  }

  public function general()
  {
    $data = [];
    $data['title'] = "General Settings";
    $this->load->view('templates/header', $data);
    $this->load->view('settings/general');
    $this->load->view('templates/footer');
  }


  public function languages()
  {

    $crud = new grocery_CRUD();

    $crud->set_table('languages');
    $crud->set_theme('datatables');
    $crud->set_subject('Languages');

    //Change field from textarea to input
    $crud->required_fields('language_title','language_slug','language_default');

    //$crud->unset_columns(array('page_parent_page_id','page_meta_keywords','page_meta_title','page_custom_h1','page_meta_description'));


    $output = $crud->render();
    $output->title = "Add/Remove Languages";
    $this->load->view('templates/header', $output);
    $this->load->view('settings/languages');
    $this->load->view('templates/footer');
  }


  public function cleanhtml()
  {
    $data['title'] = 'Clean HTML';
    if($this->input->post()){
      $string = $this->input->post('string');
      $data['string'] = cleanHTML($string);
    
    }

    $this->load->view('templates/header', $data);
    $this->load->view('settings/cleanhtml');
    $this->load->view('templates/footer');



  }

  // public function post_types()
  // {
  //
  //   $crud = new grocery_CRUD();
  //
  //   $crud->set_table('post_types');
  //   $crud->set_theme('datatables');
  //   $crud->set_subject('Post Type');
  //
  //   //Change field from textarea to input
  //   $crud->required_fields('post_type_name','post_type_template_name');
  //
  //   $crud->unique_fields(array('post_type_name'));
  //
  //   $crud->callback_before_insert(array($this,'createTemplateFile'));
  //   $crud->callback_before_update(array($this,'createTemplateFile'));
  //
  //   $output = $crud->render();
  //   $output->title = "Post Types";
  //   $this->load->view('templates/header', $output);
  //   $this->load->view('default_inner_grocery');
  //   $this->load->view('templates/footer');
  // }
  //
  //
  // public function createTemplateFile($arr){
  //   //Create file with the same name as post_type_template_name value
  //   if( ! file_exists ( APPPATH.'modules/frontend/views/templates/posts/'.$arr['post_type_template_name'].'.php' )){
  //     fopen(APPPATH.'modules/frontend/views/templates/posts/'.$arr['post_type_template_name'].'.php', "w");
  //   }else
  //     return $arr;
  // }

  // public function default_meta()
  // {
  //
  //   $crud = new grocery_CRUD();
  //
  //   $crud->set_table('default_meta');
  //   $crud->set_theme('datatables');
  //   $crud->set_subject('Default Meta');
  //
  //   //Change field from textarea to input
  //   $crud->required_fields('default_meta_title','default_meta_description','default_meta_keywords');
  //   $crud->unset_add();
  //
  //
  //   $output = $crud->render();
  //   $output->title = "Default Meta";
  //   $this->load->view('templates/header', $output);
  //   $this->load->view('settings/default_meta');
  //   $this->load->view('templates/footer');
  // }

}
