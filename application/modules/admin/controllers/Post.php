<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MX_Controller{

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
    $this->load->model('generic_model');
    $this->load->model('post_model');
    $this->load->model('frontend/frontend_model');


  }


  public function index()
  {

    $post_types = $this->db->get('post_types')->result();
    $data['post_types'] = $post_types;
    $data['title'] = "Select Post Type";
    $this->load->view('templates/header', $data);
    $this->load->view('posts/index');
    $this->load->view('templates/footer');

  }
public function post_type($post_type_id){
    $crud = new grocery_CRUD();
    $post_type = $this->post_model->getPostType($post_type_id);
    if($post_type){
      $post_type_name = ' - '.$post_type->post_type_name;
    }

    $crud->where('post_type', $post_type_id);
    $crud->set_table('posts');
    $crud->set_theme('datatables');
    $crud->set_subject('Post'.$post_type_name);

  //Custom fields for edit form
  $fields =  [    'post_id',
                  'post_language',
                //  'post_type',
                  'post_title',
                  'post_link',
                  'post_text',
                  'post_image',
                  'post_custom_h1',
                  'post_meta_title',
                  'post_meta_description',
                  'post_meta_keywords',
                  'og_meta_title',
                  'og_meta_description',
                  'og_meta_image',
                  'post_categories',
                  'post_created_at',
                  'post_updated_at',
                  'post_author'];


  //$custom_fields = $this->custom_field('phone',array($this,'check_custom_fields'));

    if($this->uri->segment(5) == 'edit'){
      $primary_key = $this->uri->segment(6);
      $custom_fields = $this->get_custom_fields($primary_key);

      if($custom_fields){
        foreach ($custom_fields as $custom_field) {
          $fields[] = $custom_field->custom_field_slug;
        }

        //Load the fields
        $crud->fields( $fields );



        //Change field_types
        $this->session->set_userdata('custom_fields', $custom_fields);

        foreach ($custom_fields as $custom_field) {


          switch ($custom_field->custom_field_type) {
            case 'text':
                $crud->callback_field($custom_field->custom_field_slug, [$this, 'custom_field_text']);
              break;
            case 'texteditor':
                $crud->callback_field($custom_field->custom_field_slug, [$this, 'custom_field_texteditor']);
              break;
            case 'string':
                $crud->callback_field($custom_field->custom_field_slug, [$this, 'custom_field_string']);
              break;
            case 'dropdown':
                $crud->callback_field($custom_field->custom_field_slug, [$this, 'custom_field_dropdown']);
              break;
            case 'multiselect':
                $crud->callback_field($custom_field->custom_field_slug, [$this, 'custom_field_multiselect']);
              break;

            default:
              $crud->change_field_type($custom_field->custom_field_slug, $custom_field->custom_field_type,explode(',', $custom_field->custom_field_values));
              break;
          }

        }

        //Change labels of custom fields
        foreach ($custom_fields as $custom_field) {
          $crud->display_as($custom_field->custom_field_slug, $custom_field->custom_field_name);
        }
      }


      //Validate and update custom_field_relation
      // foreach ($variable as $key => $value) {
      //   # code...
      // }

    }


    $crud->columns(['post_id', 'post_image','post_language','post_title', 'post_link',  'post_created_at', 'post_author', 'post_index']);
    $crud->required_fields('post_title','post_link','post_language','post_type');
    $crud->unset_texteditor('post_title','post_link','post_meta_title','post_meta_description','post_meta_keywords','og_meta_title','og_meta_description');
    $crud->callback_column('post_title', array($this, '_full_text'));


    $crud->field_type('post_title', 'input');
    $crud->field_type('post_link', 'input');
    $crud->field_type('post_type', 'hidden', $post_type_id);

    $categories = $this->generic_model->getCategories();
    $categories_array = [];

    if($categories)
    {
      foreach ($categories as $category) {
        $categories_array[$category->post_category_id] = $category->post_category_name;
      }
    }



    $crud->set_relation('post_language', 'languages', 'language_name');
    //$crud->set_relation('post_type', 'post_types', 'post_type_name');
    $crud->set_relation('og_meta_image', 'media', 'media_name', ['media_type'=>'image']);

    $crud->field_type('post_updated_at', 'invisible');
    $crud->field_type('post_author', 'invisible');
    $crud->field_type('post_id', 'invisible');

    //Avoid error if no category exists
    if($categories_array)
      $crud->field_type('post_categories', 'multiselect', $categories_array);
    else
      $crud->field_type('post_categories', 'invisible');


    $crud->add_action('View', '', '','ui-icon-image',array($this,'view_post'));
    $crud->unset_read();

    $crud->callback_column('post_author',array($this,'getUserData'));

    $crud->callback_column($this->unique_field_name('post_image'),array($this,'getImage'));
    $crud->set_relation('post_image', 'media', 'media_name', ['media_type'=>'image']);


    $crud->unique_fields(array('post_link'));

    $crud->callback_before_insert(array($this,'insert_validation'));
    $crud->callback_before_update(array($this,'update_validation'));
    $crud->callback_after_insert(array($this,'after_insert'));



    $output = $crud->render();
    $output->title = "Posts".$post_type_name;

    $this->load->view('templates/header', $output);
    $this->load->view('default_inner_grocery');
    $this->load->view('templates/footer');
  }

public function _full_text($value, $row)
{
  return $value = wordwrap($row->post_title, 500, "<br>", true);
}

public function update_custom_fields($postArr)
{
  $this->session->set_userdata('post', $postArr);
  $data = ['custom_field_relation_value'=>'test','custom_field_relation_post_id'=>1, 'custom_field_relation_custom_field_id' => 5];
  $this->db->insert('custom_field_relation', $data);
  return $postArr;

  if ( ! $this->session->has_userdata('custom_fields'))
    return $postArr;

  $custom_fields = $this->session->userdata('custom_fields');
  foreach ($custom_fields as $custom_field) {
    if( isset ($postArr[$custom_field->custom_field_name])){

      //Check if entry exists
      if( isset ($custom_field->custom_field_post_value)){
        //replace
      }else{
        $data = ['custom_field_relation_value' => $postArr[$custom_field->custom_field_name], 'custom_field_relation_post_id'=>$post_id, 'custom_field_relation_custom_field_id' => $custom_field->custom_field_id];
        //insert
        $this->db->insert('custom_field_relation', $data);
        unset($postArr[$custom_field->custom_field_name]);
      }
      // $where = ['custom_field_relation_custom_field_id' => $custom_field->custom_field_id, 'custom_field_relation_post_id' => $post_id];
      // $this->db->where($where);
      // $this->db->get()

    }
  }
  // return $postArr;
}


public function custom_field_text($value = '', $primary_key = null, $field ){

  $custom_fields = $this->session->userdata('custom_fields');

  $value = '';
  //Get the value from $custom_fields sesion
  foreach ($custom_fields as $custom_field) {
    if($custom_field->custom_field_slug != $field->name)
    continue;

    if(isset($custom_field->custom_field_post_value) && $custom_field->custom_field_post_value->custom_field_relation_value )
      $value = $custom_field->custom_field_post_value->custom_field_relation_value;

      break;
  }

  return '<textarea id="field-'.$field->name.'" name="'.$field->name.'" class="form-control">'.$value.'</textarea>';


}

public function custom_field_texteditor($value = '', $primary_key = null, $field ){

  $custom_fields = $this->session->userdata('custom_fields');

  $value = '';
  //Get the value from $custom_fields sesion
  foreach ($custom_fields as $custom_field) {
    if($custom_field->custom_field_slug != $field->name)
    continue;

    if(isset($custom_field->custom_field_post_value) && $custom_field->custom_field_post_value->custom_field_relation_value )
      $value = $custom_field->custom_field_post_value->custom_field_relation_value;

      break;
  }

  return '<textarea id="field-'.$field->name.'" name="'.$field->name.'" class="texteditor">'.$value.'</textarea>';


}

public function custom_field_string($value = '', $primary_key = null, $field ){

  $custom_fields = $this->session->userdata('custom_fields');

  $value = '';
  //Get the value from $custom_fields sesion
  foreach ($custom_fields as $custom_field) {
    if($custom_field->custom_field_slug != $field->name)
    continue;

    if(isset($custom_field->custom_field_post_value) && $custom_field->custom_field_post_value->custom_field_relation_value )
      $value = $custom_field->custom_field_post_value->custom_field_relation_value;

      break;
  }

  return '<input type="text" id="field-'.$field->name.'" name="'.$field->name.'" value="'.$value.'" class="form-control" maxlength="255"/>';


}

public function custom_field_dropdown($value = '', $primary_key = null, $field ){

  $custom_fields = $this->session->userdata('custom_fields');

  $value = '';
  //Get the value from $custom_fields sesion
  foreach ($custom_fields as $custom_field) {
    if($custom_field->custom_field_slug != $field->name)
    continue;


    if(isset($custom_field->custom_field_post_value) && $custom_field->custom_field_post_value->custom_field_relation_value )
      $value = $custom_field->custom_field_post_value->custom_field_relation_value;

      $select = '<select id="field-'.$field->name.'" name="'.$field->name.'" class="chosen-select" data-placeholder="Select '.$field->name.'"><option value=""></option>';
      $list_items = explode(',', $custom_field->custom_field_values);

      break;

  }
  $select = '<select id="field-'.$field->name.'" name="'.$field->name.'" class="chosen-select" data-placeholder="Select '.$field->name.'"><option value=""></option>';
  $list_items = explode(',', $custom_field->custom_field_values);

  foreach ($list_items as $key => $list_item) {
    $selected = ($key == $value) ? 'selected' : '';

    $select .= '<option  value="'.$key.'" '.$selected.'>'.$list_item.'</option>';
  }
  $select .= '</select>';
  return $select;


}

public function custom_field_multiselect($value = '', $primary_key = null, $field ){

  $custom_fields = $this->session->userdata('custom_fields');

  $value = [];
  //Get the value from $custom_fields sesion
  foreach ($custom_fields as $custom_field) {
    if($custom_field->custom_field_slug != $field->name)
    continue;


    if(isset($custom_field->custom_field_post_value) && $custom_field->custom_field_post_value->custom_field_relation_value )
      $value = explode(',', $custom_field->custom_field_post_value->custom_field_relation_value);

      break;

  }
  $select = '<select id="field-'.$field->name.'" name="'.$field->name.'[]" multiple="multiple" class="chosen-multiple-select" data-placeholder="Select '.$field->name.'">';
  $items = explode(',', $custom_field->custom_field_values);
  foreach ($items as $key => $item) {
    $selected = (in_array($key, $value)) ? 'selected' : '';

    $select .= '<option  value="'.$key.'" '.$selected.'>'.$item.'</option>';
  }
  $select .= '</select>';
  return $select;


}


//Get custom fields for this post_type
public function get_custom_fields($post_id){

  //get the post to get the post_type_id
  $this->load->model('frontend/frontend_model');
  $post = $this->frontend_model->getPost(['post_id' => $post_id]);
  if( !$post )
    return;
  else
    $post = $post->row();

  //Check if this post has values in custom_field_relation table
  $custom_fields = $this->frontend_model->getCustomFieldsForPostType($post->post_type_id);

  if( ! $custom_fields )
    return;

  foreach ($custom_fields->result() as $custom_field) {
    $where = ['custom_field_relation_custom_field_id' => $custom_field->custom_field_id, 'custom_field_relation_post_id' => $post_id];
    $this->db->where( $where );
    $custom_field_post_value = $this->db->get('custom_field_relation');

    if( $custom_field_post_value->num_rows() < 1 )
      continue;

      $custom_field->custom_field_post_value = $custom_field_post_value->row();

  }


  //use post_type_id to find all custom fields
  return $custom_fields->result();

}
public function view_post($primary_key, $post){
  // $default_language = $this->generic_model->getLanguage(['language_default'=>'1']);
  // if($default_language){
  //   $default_language_id = $default_language->language_id;
  // }
  //
  // $post_language = $this->generic_model->getLanguage(['language_id'=>$post->post_language]);
  //
  // //Get post type
  // $post_type = $this->generic_model->getPostType(['post_type_id'=>$post->post_type]);
  //
  //
  //
  // $base_url = ($post->post_language == $default_language_id ? base_url() : base_url($post_language->language_slug.'/'));
  //
  // return $base_url.$post_type->post_type_slug.'/'.$post->post_link;
    return get_url( 'post' , $primary_key );
}

  function unique_field_name($field_name) {
	    return 's'.substr(md5($field_name),0,8); //This s is because is better for a string to begin with a letter and not with a number
    }

  function getUserData($id){
    $user = $this->generic_model->getUserData($id);
    if($user)
      return ucfirst($user[0]->username);
    else
      return "No Author";

  }
  function getImage($id){
    $image = $this->generic_model->getImage($id);
    if($image)
      return "<img src='".base_url('assets/uploads/thumbs/')."".$image[0]->media_name."' />";
    else
      return "";

  }
  function insert_validation($post_arr){
    $post_id = $this->uri->segment(6);

    //1. Check if post_created_at is filled or empty
      if ($post_arr['post_created_at'] == '')
        $post_arr['post_created_at'] = date("Y-m-d H:i:s");
      // else
      //   $post_arr['post_created_at'] = date("Y-m-d H:i:s", strtotime($post_arr['post_created_at']));



      //Set post_author field with user ID
      $post_arr['post_author'] = $this->ion_auth->get_user_id();
      $post_arr['post_updated_at'] = date("Y-m-d H:i:s");

      $post_arr = $this->indexPost($post_arr);
      echo "<pre>";
        print_r( $post_arr ); 
      echo "</pre>";

      return $post_arr;
  }

  function update_validation($post_arr){
    //Check if post exists & get post's data from db before update
    $this->load->model('post_model');
    $post_id = $this->uri->segment(6);
    $post = $this->post_model->getPost($post_id);

    if(!$post)
      redirect(base_url('admin/post'));

    if($post_arr['post_created_at'] == '')
      $post_arr['post_created_at'] = $post->post_created_at;

    $post_arr['post_updated_at'] = date("Y-m-d H:i:s");


    //Insert into post_categories_relation table
    $post_categories_arr = (isset($post_arr['post_categories']) ? $post_arr['post_categories'] : []);
    $data['post_id'] = $post_id;
    $this->db->where('post_id',$post_id);
    $this->db->delete('post_category_relation');
    foreach ($post_categories_arr as $post_category) {
      $data['post_category_id'] = $post_category;
      $this->db->insert('post_category_relation', $data);
    }


    //Update custom fields
    if ( ! $this->session->has_userdata('custom_fields'))
      return $post_arr;

    $custom_fields = $this->session->userdata('custom_fields');


    foreach ($custom_fields as $custom_field) {
      // $data = ['custom_field_relation_value' => $post_arr[$custom_field->custom_field_name.'|asdasd'], 'custom_field_relation_post_id'=>$post_id, 'custom_field_relation_custom_field_id' => $custom_field->custom_field_id];
      // $this->db->insert('custom_field_relation', $data);
      if( isset ($post_arr[$custom_field->custom_field_slug])){
        if ( is_array($post_arr[$custom_field->custom_field_slug]) ){
          $post_arr[$custom_field->custom_field_slug] = implode(',', $post_arr[$custom_field->custom_field_slug]);
        }
        //Check if entry exists
        if( isset ($custom_field->custom_field_post_value)){
          //update
          $data = ['custom_field_relation_value' => $post_arr[$custom_field->custom_field_slug], 'custom_field_relation_post_id'=>$post_id, 'custom_field_relation_custom_field_id' => $custom_field->custom_field_id];
          $where = ['custom_field_relation_id' => $custom_field->custom_field_post_value->custom_field_relation_id];
          $this->db->trans_start();
          $this->db->where($where);
          $this->db->update('custom_field_relation', $data);
          $this->db->trans_complete();
        }else{
          //insert
          $data = ['custom_field_relation_value' => $post_arr[$custom_field->custom_field_slug], 'custom_field_relation_post_id'=>$post_id, 'custom_field_relation_custom_field_id' => $custom_field->custom_field_id];
          $this->db->insert('custom_field_relation', $data);
        }
        unset($post_arr[$custom_field->custom_field_slug]);

      }

    }
    $custom_fields = $this->get_custom_fields($post_id);
    $this->session->set_userdata('custom_fields', $custom_fields);
    $post_arr = $this->indexPost($post_arr);
    return $post_arr;
  }


  function after_insert($post_arr,$primary_key){
      $data['post_id']  = $primary_key;
      //Insert into post_categories_relation table
      $post_categories_arr = $post_arr['post_categories'];
      if(count($post_categories_arr) > 0){
          foreach ($post_categories_arr as $post_category) {
                $data['post_category_id'] = $post_category;
                $this->db->insert('post_category_relation', $data);
              }
        }
      return true;
  }


  public function indexPost($arr){
    if(!isset($arr['post_index']) || $arr['post_index'] == ''){
      $arr['post_index'] = 'Yes';
    }
    return $arr;
  }

  public function categories()
  {
      // foreach ($this->db->query('DESCRIBE posts')->result() as $col) {
      //   echo "$col->Field </br>";
      // }
    $crud = new grocery_CRUD();

    $crud->set_table('post_categories');
    $crud->set_theme('datatables');
    $crud->set_subject('Category');

  //  $crud->unset_fields('post_link','post_text','post_image','post_meta_title','post_meta_description','post_meta_keywords','og_meta_title','og_meta_description','og_meta_image','post_updated_at');

  $crud->fields(  'post_category_language',
                  'post_category_post_type',
                  'post_category_name',
                  'post_category_slug',
                  'post_category_text',
                  'post_category_featured_image',
                  'post_category_custom_h1',
                  'post_category_meta_title',
                  'post_category_meta_description',
                  'post_category_meta_keywords',
                  'post_category_og_title',
                  'post_category_og_description',
                  'post_category_og_image',
                  'post_category_updated_at',
                  'post_category_created_at',
                  'post_category_index');
    $crud->columns(['post_category_id',
                    // 'post_category_featured_image',
                    'post_category_name',
                    // 'post_category_custom_h1',
                    'post_category_post_type',
                    'post_category_language',
                    'post_category_slug',
                    'post_category_created_at',
                    'post_category_index']);
    $crud->required_fields('post_category_name','post_category_post_type', 'post_category_language','post_category_slug');

    $crud->unset_texteditor('post_category_meta_description','post_category_meta_keywords', 'post_category_og_description');
    $crud->field_type('post_category_og_meta_description', 'text');

    $crud->set_relation('post_category_language', 'languages', 'language_name');
    $crud->set_relation('post_category_featured_image', 'media', 'media_name', ['media_type'=>'image']);
    $crud->set_relation('post_category_og_image', 'media', 'media_name', ['media_type'=>'image']);
    $crud->set_relation('post_category_post_type', 'post_types', 'post_type_name');

    //$crud->field_type('post_category_created_at', 'invisible');
    $crud->field_type('post_category_updated_at', 'invisible');

    $crud->unique_fields(array('post_category_name','post_category_slug'));

    $crud->callback_before_insert(array($this,'category_insert_validation'));
    $crud->callback_before_update(array($this,'category_update_validation'));


    $output = $crud->render();
    $output->title = "Categories";

    $this->load->view('templates/header', $output);
    $this->load->view('default_inner_grocery');
    $this->load->view('templates/footer');
  }




  function category_insert_validation($cat_arr){
    $cat_arr['post_category_updated_at'] = $cat_arr['post_category_created_at'] = date("Y-m-d H:i:s");

    //Sanitize category slug
    $cat_arr['post_category_slug'] = str_replace(' ', '_', $cat_arr['post_category_slug']);
      $cat_arr = $this->indexCategory($cat_arr);
    return $cat_arr;
  }

  function category_update_validation($cat_arr){
    $cat_arr['post_category_updated_at'] = date("Y-m-d H:i:s");

    //Sanitize category slug
    $cat_arr['post_category_slug'] = str_replace(' ', '_', $cat_arr['post_category_slug']);
    $cat_arr = $this->indexCategory($cat_arr);
    return $cat_arr;
  }

  public function indexCategory($arr){
    if(!isset($arr['post_category_index']) || $arr['post_category_index'] == ''){
      $arr['post_category_index'] = 'Yes';
    }
    return $arr;
  }
  public function post_types()
  {

    $crud = new grocery_CRUD();

    $crud->set_table('post_types');
    $crud->set_theme('datatables');
    $crud->set_subject('Post Type');

    $crud->columns(['post_type_id',
                    'post_type_language_id',
                    'post_type_name',
                    'post_type_slug',
                    'post_type_text',
                    'post_type_file_name',
                    'post_type_posts_per_page',
                    'post_type_index',
                    ]);

    $crud->unset_texteditor('post_type_meta_title','post_type_meta_description','post_type_meta_keywords','post_type_og_title','post_type_og_description');

    //Change field from textarea to input
    $crud->field_type('post_type_id', 'invisible');
    $crud->required_fields('post_type_type_name','post_type_slug');
    $crud->unique_fields(array('post_type_name'));

    $crud->set_relation('post_type_og_image', 'media', 'media_name', ['media_type'=>'image']);
    $crud->set_relation('post_type_featured_image', 'media', 'media_name', ['media_type'=>'image']);
    $crud->set_relation('post_type_language_id', 'languages', 'language_name');

    $crud->callback_before_insert(array($this,'postTypeBeforeInsert'));
    $crud->callback_before_update(array($this,'postTypeBeforeUpdate'));

    $output = $crud->render();
    $output->title = "Post Types";
    $this->load->view('templates/header', $output);
    $this->load->view('default_inner_grocery');
    $this->load->view('templates/footer');
  }

  public function custom_fields()
  {

    $crud = new grocery_CRUD();

    $crud->set_table('custom_fields');
    $crud->set_theme('datatables');
    $crud->set_subject('Custom Fields');

    $crud->columns(['custom_field_id',
                    'custom_field_name',
                    'custom_field_slug',
                    'custom_field_post_type_id',
                    'custom_field_type',
                    'custom_field_values',
                    ]);


    //Change field from textarea to input
    $crud->field_type('custom_field_id', 'invisible');
    $crud->unique_fields(array('custom_field_name','custom_field_slug'));
    $crud->unset_texteditor('custom_field_values');
    $crud->required_fields('custom_field_name','custom_field_post_type_id','custom_field_type', 'custom_field_slug');

    $crud->set_relation('custom_field_post_type_id', 'post_types', 'post_type_name');

    $crud->display_as('custom_field_post_type_id','Post Type');

    $crud->callback_field('custom_field_values',array($this,'custom_field_values_helper_text'));
    $crud->callback_field('custom_field_slug',array($this,'custom_field_slug_helper_text'));

    $output = $crud->render();
    $output->title = "Custom Fields";
    $this->load->view('templates/header', $output);
    $this->load->view('default_inner_grocery');
    $this->load->view('templates/footer');
  }

  public function custom_field_values_helper_text($value = '', $primary_key = null){
    return '<textarea id="field-custom_field_values" name="custom_field_values" class="form-control">'.$value.'</textarea><p class="text-muted">Enter values only if "Custom field type" is dropdown or multiselect.<br/>Values must be comma separated. (ex: banana, lemon, apple, orange)</p>';
  }
  public function custom_field_slug_helper_text($value = '', $primary_key = null){
    return '<input type="text" maxlength="255" value="'.$value.'" name="custom_field_slug" /><p class="text-muted"> It is required to use only latin letters and numbers without spaces</p>';
  }
  public function postTypeBeforeUpdate($arr, $primary_key){

    //Create Template File
    $arr = $this->copyTemplateFile($arr, $primary_key);

    //Prevent posts per page being blank
    $arr = $this->postPerPage($arr);
    $arr = $this->indexPostType($arr);

    return $arr;
  }

  public function postTypeBeforeInsert($arr){

    //Create post type folder with files
    $arr = $this->createTemplateFile($arr);

    //Prevent posts per page being blank
    $arr = $this->postPerPage($arr);
    $arr = $this->indexPostType($arr);
    return $arr;
  }

  public function indexPostType($arr){
    if(!isset($arr['post_type_index']) || $arr['post_type_index'] == ''){
      $arr['post_type_index'] = 'Yes';
    }
    return $arr;
  }

  public function copyTemplateFile($arr, $primary_key){
    $language = $this->frontend_model->getLanguage(['language_id'=>$arr['post_type_language_id']]);
    $new_language = $language->language_slug;


    $post_type = $this->post_model->getPostType($primary_key);
    $orig_language = $post_type->language_slug;

    if($post_type)
       $src = APPPATH.'modules/frontend/views/posts/'.$orig_language.'/'.$post_type->post_type_file_name;
    else
      return $arr;


    if($arr['post_type_language_id'] != $post_type->post_type_language_id){

    }


    // To copy the existing folder first we must check if folder with the new name already exists to prevent
    // it from losing the existing files
    // Therefore, if destination folder with new name already exists we won't run the copy functionality at all.
    // Otherwise we will create a new empty folder
    $file_name = $arr['post_type_file_name'];
    $dst = APPPATH.'modules/frontend/views/posts/'.$new_language.'/'.$file_name;
     if( ! file_exists ($dst)){

       //Check if specific language older exists
       if( ! file_exists (APPPATH.'modules/frontend/views/posts/'.$new_language))
          mkdir(APPPATH.'modules/frontend/views/posts/'.$new_language);

        //Create new folder with new post_type_file_name
       mkdir(APPPATH.'modules/frontend/views/posts/'.$new_language.'/'.$file_name);

     }
    else
      return $arr;

     if($this->copy_folder($src, $dst))
      return $arr;

      return;

  }

  public function copy_folder($src, $dst){
    $this->db->insert('test', ['text'=>$src]);
    if ($dh = opendir($src)){
      while (($file = readdir($dh)) !== false){
        if (( $file != '.' ) && ( $file != '..' ))
          copy($src.'/'.$file, $dst.'/'.$file);
      }
      closedir($dh);
    }

    return true;
  }


  public function createTemplateFile($arr){


    $language = $this->frontend_model->getLanguage(['language_id'=>$arr['post_type_language_id']]);
    $language = $language->language_slug;

    $file_name = $arr['post_type_file_name'];
    if($arr['post_type_file_name'] == ''){
      $file_name = 'blog';
      $arr['post_type_file_name'] = 'blog';
    }
    //Create file with the same name as post_type_slug value
    if( ! file_exists ( APPPATH.'modules/frontend/views/posts' ))
      mkdir(APPPATH.'modules/frontend/views/posts');

    if( ! file_exists ( APPPATH.'modules/frontend/views/posts/'.$language ))
      mkdir(APPPATH.'modules/frontend/views/posts/'.$language);

    if( ! file_exists ( APPPATH.'modules/frontend/views/posts/'.$language.'/'.$file_name)){
      mkdir(APPPATH.'modules/frontend/views/posts/'.$language.'/'.$file_name);

      //Create post type template file
      $post_type_file = fopen(APPPATH.'modules/frontend/views/posts/'.$language.'/'.$file_name.'/post_type.php', "w");
      $post_type_template = $this->post_type_template($arr);
      fwrite($post_type_file, $post_type_template);
      fclose($post_type_file);

      //Create post category template file
      $post_category_file = fopen(APPPATH.'modules/frontend/views/posts/'.$language.'/'.$file_name.'/category.php', "w");
      $post_category_template = $this->post_category_template($arr);
      fwrite($post_category_file, $post_category_template);
      fclose($post_category_file);

      //Create single post template file
      $single_post_file = fopen(APPPATH.'modules/frontend/views/posts/'.$language.'/'.$file_name.'/single_post.php', "w");
      $single_post_template = $this->single_post_template($arr);
      fwrite($single_post_file, $single_post_template);
      fclose($single_post_file);

    }

    return $arr;
  }

  public function postPerPage($arr){

    if($arr['post_type_posts_per_page'] < 1){
      $arr['post_type_posts_per_page'] = 10;
    }
      return $arr;
  }


  public function post_type_template($arr){
    $text ='<div class="col-sm-12">
  <?= $content ?>
  <hr>
</div>


<div class="col-sm-9">
<?php $categories = getPostCategories("'.$arr['post_type_name'].'"); ?>
<?php if($categories) : ?>
<h2>Categories</h2>
<?php
//Category Loop
foreach ($categories as $category) : ?>
<article class="">
                              <div class=""> <img src="<?=  base_url("assets/uploads/".$category->media_name) ?>" alt="<?=  $category->media_alt_text ?>" title="<?=  $category->media_title ?>"> </div>
                              <div class="">
                                <header class="">
                                  <div class="">
                                    <div class=""> <a href="<?= get_url("post_category", $category->post_category_id) ?>"></a></div>
                                  </div>
                                  <h3 class=""> <a href="<?= get_url("post_category", $category->post_category_id) ?>" ><?= $category->post_category_name ?></a> </h3>
                                </header>
                                <div class="">
                                  <p><?= $category->post_category_meta_description ?></p>
                                </div>
                              </div>
                              <footer class="">
                                <div class=""> <span>
                                <a href="<?= get_url("post_category", $category->post_category_id) ?>">
                                  View Posts
                                </a>
                              </span> </div>
                              </footer>
                            </article>
<?php endforeach; ?>
<?php endif; ?>

<h2>Posts</h2>

<?php
//Post Loop
          if($posts) :
              foreach ($posts as $post) :
                $post_url = get_url("post",$post->post_id) ;
                ?>
                <article class="">
                  <header class="">
                    <h2><a href="<?= $post_url ?>"><?= $post->post_title ?></a></h2>
                    <time class="" datetime="<?= $post->post_updated_at; ?>" pubdate>Updated: <?= date("d M Y", strtotime( $post->post_updated_at ) );  ?></time>
                    <figure class="">
                      <a href="<?= $post_url ?>">
                        <img src="<?= base_url("assets/uploads/".$post->media_name); ?>"
                          alt="<?= $post->media_alt_text ?>"
                          title="<?= $post->media_title ?>" />
                      </a>
                      <figcaption><?= $post->media_title ?></figcaption>
                    </figure>

                  </header>
                  <p><?=  (strlen(strip_tags($post->post_text)) > 320 ) ? mb_substr(strip_tags($post->post_text), 0, 320)."..." : $post->post_text ; ?></p>
                    <footer class="clearfix">
                        <a href="<?= $post_url ?>" class="btn btn-primary">Read more</a>

                  </footer>
                </article>
                <?php
              endforeach;
          else :   ?>

            <h3 class="text-center">Δεν βρέθηκαν αποτελέσματα.</h3>
            <?php endif;  ?>
</div>
<div class="col-sm-3">
  Widgets go here
</div>
  ';


  return $text;
  }
  public function post_category_template($arr){
    $text ='<div class="col-sm-12">
  <?= $content ?>
  <hr>
  </div>


  <div class="col-sm-9">
  <h2>Posts</h2>

  <?php
  //Post Loop
          if($posts) :
              foreach ($posts as $post) :
                $post_url = get_url("post",$post->post_id) ;
                ?>
                <article class="">
                  <header class="">
                    <h2><a href="<?= $post_url ?>"><?= $post->post_title ?></a></h2>
                    <time class="" datetime="<?= $post->post_updated_at; ?>" pubdate>Updated: <?= date("d M Y", strtotime( $post->post_updated_at ) );  ?></time>
                    <figure class="">
                      <a href="<?= $post_url ?>">
                        <img src="<?= base_url("assets/uploads/".$post->media_name); ?>"
                          alt="<?= $post->media_alt_text ?>"
                          title="<?= $post->media_title ?>" />
                      </a>
                      <figcaption><?= $post->media_title ?></figcaption>
                    </figure>

                  </header>
                  <p><?=  (strlen(strip_tags($post->post_text)) > 320 ) ? mb_substr(strip_tags($post->post_text), 0, 320)."..." : $post->post_text ; ?></p>
                    <footer class="clearfix">
                        <a href="<?= $post_url ?>" class="btn btn-primary">Read more</a>

                  </footer>
                </article>
                <?php
              endforeach;
          else :   ?>

            <h3 class="text-center">Δεν βρέθηκαν αποτελέσματα.</h3>
            <?php endif;  ?>
  </div>
  <div class="col-sm-3">
  <div class="widget">
  <h3 class="widget-title">Categories</h3>
  <hr class="">

<?php $categories = getPostCategories($post_type->post_type_name); ?>
    <?php if($categories) : ?>
          <ul class="list1 no-bullets">
              <?php foreach ($categories as $category) : ?>
              <li>
                   <a href="<?= get_url("post_category", $category->post_category_id) ?>" class="text-center"><img class="img-responsive" src="<?= base_url("assets/uploads/".$category->media_name) ?>" alt="<?= $category->media_alt_text?>" title="<?= $category->media_title?>">
                   <h5 class="mt1"><?= $category->post_category_name ?></h5></a>
              </li>
           <?php endforeach; ?>
         </ul>
    <?php endif; ?>
  </div>
</div>
  ';


  return $text;
  }

  public function single_post_template($arr){
    $text ='
<div class="col-sm-9">
    <article class="">
      <header class="">
        <h1><?= $title ?></h1>
        <time class="" datetime="<?= $post->post_updated_at; ?>" pubdate>Updated: <?= date("d M Y", strtotime( $post->post_updated_at ) );  ?></time>
        <figure class="">
            <img src="<?= base_url("assets/uploads/".$post->media_name); ?>"
              alt="<?= $post->media_alt_text ?>"
              title="<?= $post->media_title ?>" />
          <figcaption><?= $post->media_title ?></figcaption>
        </figure>

      </header>
    <?= $content ?>
        <footer class="clearfix">

      </footer>
    </article>
    </div>
    <div class="col-sm-3">
    Widgets go here
    </div>
     ';

  return $text;
  }
//Ilektrologoi24
function updatedescription(){
  exit();
  $this->db->where('post_type', 2);
  $posts = $this->db->get('posts')->result();
  foreach ($posts as $post) {
  echo $post->post_link."<br>";
    $descdescr = str_replace('στις καλύτερες τιμές', 'κοντά σας', $post->post_meta_description);
    //$descdescr = str_replace('Για κεραίες', 'Για εγκατάσταση επίγειας κεραίας', $descdescr);
    //echo "$descdescr<br>";
    $this->db->where('post_id',$post->post_id);
    $this->db->update('posts', ['post_meta_description'=>$descdescr, 'og_meta_description'=>$descdescr]);
  }

}
function tags(){
  exit();
  // ExcelFile($filename, $encoding);
  //$data = new Spreadsheet_Excel_Reader();


  // Set output Encoding.
//  $data->setOutputEncoding('UTF-8');
  //$data->read('/home/ufrfegnl/public_html/assets/uploads/excel.xls');


// Featured images id for each post
//  $p = [19,21,20,26,24,22,18,27,23,28,25];

//Pattern for links of each service
$l = ["hire-web-designer---link--",
"hire-javascript-developer---link--",
"hire-backend-developer---link--",
"hire-codeigniter-developer---link--",
"hire-woocommerce-developer---link--",
"hire-wordpress-develope---link--",
"hire-php-developer---link--"];

//Pattern for title of each service
  $t = ["Hire Web Designer - --replace7--",
"Hire JavaScript Developer - --replace7--",
"Hire Back-end Developer - --replace7--",
"Hire CodeIgniter Developer - --replace7--",
"Hire Woocommerce Developer - --replace7--",
"Hire WordPress Developer - --replace7--",
"Hire PHP Developer - --replace7--"];

//Pattern for description of each service
  $d = [
"Hire Web Designer --from-- with creativity and imagination. We offer Hire Web Designer services to --replace7-- businesses and individuals.",
"Hire Javascript Developer --from-- with the right expertise and experience. Transform your web app by hiring Javascript developer --replace7--.",
"Hire Backend developer with a perfect skill set --from--. We offer Hire Backend Developer services to --replace7-- businesses and individuals.",
"Hire Codeigniter Developer with deep knowledge of PHP framework --from--. We offer Hire Codeigniter Developer services to --replace7-- businesses and individuals.",
"Hire Woocommerce Developer with the right skills --from--. We offer Hire Woocommerce Developer services to --replace7-- businesses and individuals.",
"Hire Wordpress Developer of the highest quality --from--. We offer Hire Wordpress Developer services to --replace7-- businesses and individuals.",
"Hire PHP Developer with exceptional skills to outsource your project --from--. Qualified and certified PHP developers are available for you in --replace7--."];

//Pattern for keywords of each service
$k = [
  "Hire Web Designer --replace7--, Hire Web Designer, Hire Dedicated Web Designer ",
  "Hire Javascript Developer --replace7--, Hire Javascript Developer, Hire Dedicated Javascript Developer ",
  "Hire Backend developer --replace7--, Hire Backend developer, Hire Dedicated Backend developer ",
  "Hire Codeigniter Developer --replace7--, Hire Codeigniter Developer, Hire Dedicated Codeigniter Developer ",
  "Hire Woocommerce Developer --replace7--, Hire Woocommerce Developer, Hire Dedicated Woocommerce Developer ",
  "Hire Wordpress Developer --replace7--, Hire Wordpress Developer, Hire Dedicated Wordpress Developer ",
  "Hire PHP Developer --replace7--, Hire PHP Developer, Hire Dedicated PHP Developer "];
//$p = [118];
//$l = ['pistopoihtiko-dei---replace7--'];
//$t = ["ΠΙΣΤΟΠΟΙΗΤΙΚΟ ΔΕΗ --replace4--, ΕΚΔΟΣΗ ΠΙΣΤΟΠΟΙΗΤΙΚΟΥ ΔΕΗ"];
//$d = ['Για πιστοποιητικό ΔΕΗ --replace7a-- καλέστε μας και έμπειροι ηλεκτρολόγοι σε λογικές τιμές και κόστη θα εκδώσουν τα πιστοποιητικά που επιθυμείτε.'];
//$k = ['ΠΙΣΤΟΠΟΙΗΤΙΚΟ ΔΕΗ --replace4--, ΠΙΣΤΟΠΟΙΗΤΙΚΑ ΔΕΗ --replace4--, ΕΚΔΟΣΗ ΠΙΣΤΟΠΟΙΗΤΙΚΟΥ ΔΕΗ --replace4--, ΕΚΔΟΣΗ ΠΙΣΤΟΠΟΙΗΤΙΚΩΝ ΔΕΗ --replace4--, ΠΙΣΤΟΠΟΙΗΤΙΚΟ ΔΕΗ --replace4-- ΤΙΜΕΣ ΚΟΣΤΗ'];
$f = 0;
  error_reporting(E_ALL ^ E_NOTICE);
//echo $data->sheets[0]['cells'][1][7];
$this->db->where('post_type', 3);
$cs = $this->db->get('posts')->result();


foreach ($cs as $res) {
  // code...
      $title = $res->post_title;
      if(!$res)
        continue;



        $from = 'from '.$title;
        $replace7 = $title;
        $url = $res->post_link;


        for ($g=0; $g < count($l); $g++) {
          $link = $l[$g];
          $title = $t[$g];
          $descr = $d[$g];
          $key = $k[$g];
          $image = 0;

          $toBeReplaced = ['--from--','--replace7--', '--link--'];
          $with = [$from,  $replace7, $url];

          $link = str_replace($toBeReplaced, $with, $link);
          $title = str_replace($toBeReplaced, $with, $title);
          $descr = str_replace($toBeReplaced, $with, $descr);
          $key = str_replace($toBeReplaced, $with, $key);

          $newData['post_language'] = 2;
          $newData['post_type'] = 5;
          $newData['post_created_at'] = $newData['post_updated_at'] = date("Y-m-d H:i:s");
          $newData['post_categories'] = '';
          $newData['post_author'] = 1;

          $newData['post_link'] = $link;
          $newData['post_image'] = $image;
          $newData['post_title'] = $newData['post_custom_h1'] = $newData['post_meta_title'] = $newData['og_meta_title'] = $title;
          $newData['post_meta_description'] = $newData['og_meta_description'] = $descr;
          $newData['post_meta_keywords'] = $key;


          $this->db->insert('posts', $newData);
          $post_id = $this->db->insert_id();

          $customData['custom_field_relation_post_id'] = $post_id;
          $customData['custom_field_relation_custom_field_id'] = 2;
          $customData['custom_field_relation_value'] = $res->post_id;

          $this->db->insert('custom_field_relation', $customData);
        }


// echo "<pre>";
//   print_r( $newData );
// echo "</pre>";
      // $this->db->where('post_id', $res->post_id);
      // $this->db->update('posts', $newData);

       //break;


  }

  //print_r($data);
//  print_r($data->formatRecords);
}


public function countries(){
  exit();
  require APPPATH.'vendor/autoload.php';
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xls');
  $reader->setReadDataOnly(TRUE);
  $file = FCPATH.'assets/uploads/cities.xls';
  $spreadsheet = $reader->load($file);
  $worksheet = $spreadsheet->getActiveSheet();

  $highestRow = $worksheet->getHighestRow(); // e.g. 10
  $highestColumn = 'B'; // e.g 'F'
  $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

  $description = 'Hire developer from your office or home in country. Developer to hire is available remotely to work with you in country for your web development project.';
  $keywords = 'hire developer country, hire php developer country, hire a developer, hire dedicated developer, developer to hire in country';
for ($row = 1; $row <= $highestRow; ++$row) {
    for ($col = 1; $col <= 1; ++$col) {
        $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
        $country_id = (int) $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $value = trim(preg_replace("/[^a-zA-Z -]+/", "", $value));
        //$value is country name;
        $descr = str_replace('country', ucfirst($value), $description);
        $len = strlen($value);
        $title = 'How-to Hire Developer from your office or home in country';
        if($len > 10)
        $descr = str_replace(' or home', '', $descr);

      //  continue;
        $newData['post_image'] = 0;
        $newData['post_custom_h1'] = $newData['post_meta_title'] = $newData['og_meta_title'] = str_replace('country', ucfirst($value), $title);
        $newData['post_meta_description'] = $newData['og_meta_description'] = $descr;
        $newData['post_meta_keywords'] = str_replace('country', ucfirst($value), $keywords);
        $newData['post_link'] = str_replace(' ', '-', trim(strtolower($value)));
        $newData['post_title'] =  ucfirst($value);
        $newData['post_author'] = 1;
        $newData['post_categories'] = 1;
        $newData['post_type'] = 3;
        $newData['post_language'] = 2;
        $newData['post_created_at'] = $newData['post_updated_at'] = date("Y-m-d H:i:s");

        $record = $this->db->insert('posts', $newData);
        $id = $this->db->insert_id();

        //add category relation
        $catData['post_category_id'] = 2;
        $catData['post_id'] = $id;
        $this->db->insert('post_category_relation', $catData);

        //add custom field relation
        $relData['custom_field_relation_custom_field_id'] = 1;
        $relData['custom_field_relation_post_id'] = $id;
        $relData['custom_field_relation_value'] = $country_id;
        $this->db->insert('custom_field_relation', $relData);


    }
}



}
public function xls(){
exit();
  // ExcelFile($filename, $encoding);
  $data = new Spreadsheet_Excel_Reader();


  // Set output Encoding.
  $data->setOutputEncoding('UTF-8');



  $data->read(FCPATH.'assets/uploads/excel.xls');



  error_reporting(E_ALL ^ E_NOTICE);
//echo $data->sheets[0]['cells'][1][7];
  for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
    $cell = $data->sheets[0]['cells'];
  		$title = $cell[$i][7];
      $this->db->where('post_title', $title);
      $res = $this->db->get('posts')->row();
      if(!$res)
        continue;

        $newData['post_link'] = $cell[$i][9];
        $newData['post_image'] = 0;
        $newData['post_custom_h1'] = $newData['post_meta_title'] = $newData['og_meta_title'] = $cell[$i][13];
        $newData['post_meta_description'] = $newData['og_meta_description'] = $cell[$i][17];
        $newData['post_meta_keywords'] = $cell[$i][20];
        $newData['post_link'] = $cell[$i][9];


      $this->db->where('post_id', $res->post_id);
      $this->db->update('posts', $newData);

       //break;
  }


  //print_r($data);
//  print_r($data->formatRecords);
}

}
