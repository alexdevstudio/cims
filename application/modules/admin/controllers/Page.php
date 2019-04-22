<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller{

  public function __construct()
  {
    parent::__construct();

    if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('/admin/login', 'refresh');
		}
    $this->load->library('grocery_CRUD');
    $this->load->model('crud/grocery_crud_model');
    $this->load->model('frontend/frontend_model');
  }

  function index()
  {

    $crud = new grocery_CRUD();

    $crud->set_table('pages');
    $crud->set_theme('datatables');
    $crud->set_subject('Pages');

    //Change field from textarea to input
    $crud->field_type('page_link', 'input');
    $crud->field_type('page_og_title', 'input');
    $crud->display_as('page_depth_level','Page Depth');
    $crud->unset_texteditor('page_link','page_meta_description','page_og_description');
    $crud->columns(['page_id', 'page_title', 'page_link', 'page_language', 'page_template_file', 'page_parent_page_id', 'page_depth_level', 'page_index']);
    $crud->required_fields('page_link','page_language','page_title');
    $crud->set_relation('page_language', 'languages', 'language_name');
    $crud->set_relation('page_og_image', 'media', 'media_name', ['media_type'=>'image']);
    $crud->add_action('View', '', '','ui-icon-image',array($this,'view_page'));
    $crud->order_by('page_id','desc');
    $crud->unset_read();
    //$crud->unset_columns(array('page_parent_page_id','page_meta_keywords','page_meta_title','page_custom_h1','page_meta_description'));

    $crud->callback_before_insert(array($this,'pageBeforeInsert'));
    $crud->callback_before_update(array($this,'pageBeforeUpdate'));

    $output = $crud->render();
    $output->title = 'Pages';

    $this->load->view('templates/header', $output);
    $this->load->view('pages/pages');
    $this->load->view('templates/footer');
  }

  function view_page ($primary_key, $row) {
    $language = $this->frontend_model->getLanguage(['language_default'=>'1']);
    if($language){
      $default_language = $language->language_slug;
    }

    $base_url = ($row->page_language == $default_language ? base_url() : base_url($row->page_language.'/'));

    return $base_url.$row->page_link;

  }

  public function pageBeforeInsert($arr){
    //Create Template File
    $arr = $this->checkParentAndDepthId($arr);
    $arr = $this->indexPage($arr);
    $arr = $this->createTemplateFile($arr);
    return $arr;
  }

  public function pageBeforeUpdate($arr){
    //Create Template File
    $arr = $this->checkParentAndDepthId($arr);
    $arr = $this->indexPage($arr);
    $arr = $this->createTemplateFile($arr);
    return $arr;
  }
  public function indexPage($arr){
    if(!isset($arr['page_index']) || $arr['page_index'] == ''){
      $arr['page_index'] = 'Yes';
    }
    return $arr;
  }
  public function checkParentAndDepthId($arr){
    $page_parent_id = (isset($arr['page_parent_id']) ? $arr['page_parent_id'] : 0);
    $page_depth = (isset($arr['page_depth']) ? $arr['page_depth'] : 0);
    if($page_parent_id == '')
      $arr['page_parent_id'] = 0;

    if($page_depth == '')
      $arr['page_depth'] = 0;

      return $arr;
  }

  public function createTemplateFile($arr){

    $language = $this->frontend_model->getLanguage(['language_id'=>$arr['page_language']]);
    $language = $language->language_slug;

    $file_name = $arr['page_template_file'];
    if($arr['page_template_file'] == ''){
      $file_name = 'default';
      $arr['page_template_file'] = 'default';
    }
    //Create file with the same name as post_type_slug value
    if( ! file_exists ( APPPATH.'modules/frontend/views/pages' ))
      mkdir(APPPATH.'modules/frontend/views/pages');

    if( ! file_exists ( APPPATH.'modules/frontend/views/pages/'.$language ))
      mkdir(APPPATH.'modules/frontend/views/pages/'.$language);

    if( ! file_exists ( APPPATH.'modules/frontend/views/pages/'.$language.'/'.$file_name.'.php' )){
      $file_name =  fopen(APPPATH.'modules/frontend/views/pages/'.$language.'/'.$file_name.'.php', "w");
      $txt = '<?= $content ?>';
      fwrite($file_name, $txt);
      fclose($file_name);
    }
      return $arr;
  }

}
