<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends MX_Controller{

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
  }

  function index()
  {

    $crud = new grocery_CRUD();

    $crud->set_table('media');
    $crud->set_theme('datatables');
    $crud->set_subject('Media');

    $crud->order_by('media_id','desc');

    $crud->field_type('media_name', 'input');
    $crud->field_type('media_title', 'input');
    $crud->field_type('media_alt_text', 'input');
    $crud->columns(['media_id', 'media_type', 'media_name', 'media_title', 'media_alt_text']);

    $crud->unset_columns(array('media_uploaded_date'));
    //$crud->unset_edit();
    $crud->unset_export();
    $crud->unset_print();
    $crud->unset_add();



    $crud->display_as('media_name','URL');
    $crud->callback_column('media_name', array($this, 'mediaUrl'));
    $crud->callback_delete(array($this,'delete'));

    $data = $crud->render();
    $data->js_files[] = "https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js";
    $data->js_files[] = base_url('assets/admin/dist/js/dropzone.js');
    $data->js_files[] = base_url('assets/admin/dist/js/media.js');


    $data->title = 'Media';

    $this->load->view('templates/header', $data);
    $this->load->view('media/media');
    //$this->_example_output($output);
    $this->load->view('templates/footer');

  }


  public function mediaUrl($value, $row){
    if($row->media_type == 'image'){
    $img_src = base_url('assets/uploads/thumbs/'.$value);
    $img_arr = explode('.', $value);
    $isSVG = ($img_arr[count($img_arr) - 1] == 'svg' ? true : false);
    if($isSVG)
      $img_src = base_url('assets/uploads/'.$value);


      return '<div class="row">
                <div class="col-sm-6">
                  <img id="media-'.$row->media_id.'" width="75"  class="lazy" data-src="'.$img_src.'" />
                </div>
                <input type="text" style="position:absolute;top:-100000%" id="full'.$row->media_id.'"  value="'.base_url('assets/uploads/'.$row->media_name).'">
                <input type="text" style="position:absolute;top:-100000%"   id="medium'.$row->media_id.'" value="'.base_url('assets/uploads/medium/'.$row->media_name).'">
                <input type="text" style="position:absolute;top:-100000%"   id="thumb'.$row->media_id.'" value="'.base_url('assets/uploads/thumbs/'.$row->media_name).'">
                <div  style="font-size:13px" class="col-sm-5 copy-media-url col-sm-offset-1">
                  <span class="copy"  data-clipboard-action="copy" data-clipboard-target="#full'.$row->media_id.'">Full URL</span> <br/>
                  <span class="copy"  data-clipboard-action="copy" data-clipboard-target="#medium'.$row->media_id.'">Medium URL</span> <br/>
                  <span class="copy"  data-clipboard-action="copy" data-clipboard-target="#thumb'.$row->media_id.'">Thumb URL</span>
                </div>
                <div class="col-xs-12">'.$row->media_name.'</div>
              </div>';
    }else
      return $value;
  }

 function delete($media_id) {
   $this->db->where('media_id', $media_id);
   $file = $this->db->get('media')->row();

   //Delete the file
   unlink('assets/uploads/'.$file->media_name);

   // Delete the thumb is it is image
   if($file->media_type == 'image'){
     unlink('assets/uploads/medium/'.$file->media_name);
     unlink('assets/uploads/thumbs/'.$file->media_name);
  }

   $this->db->where('media_id', $media_id);
   $this->db->delete('media');

   return true;
 }

 //Function that generates Media JSON feed for Text Editor
 function feed(){
   $media = $this->db->get('media');

   if($media->num_rows() < 1)
    {
      echo '';
      return;
     }

    $media = $media->result();

    foreach ($media as $image) {
      $feed[] = ['thumb'=>base_url('assets/uploads/thumbs/'.$image->media_name),'image'=>base_url('assets/uploads/'.$image->media_name)];
    }
   $feed = json_encode($feed);
   echo $feed;
 }
  function upload(){


    if (!file_exists('assets'))
		    mkdir('assets', 0777, true);

    if (!file_exists('assets/uploads'))
		    mkdir('assets/uploads', 0777, true);

    $post = $this->input->post();
    $config['upload_path'] = "assets/uploads";
    $config['allowed_types'] = "jpg|png|jpeg|pdf|svg";
    $config['max_size'] = "10000";


    $txteditor = false;
    if(isset($_FILES['file'])){
      $file_original_name = explode('.', $_FILES['file']['name']);
      $upload = 'file';
    }
    elseif (isset($_FILES['upload'])) {
      $file_original_name = explode('.', $_FILES['upload']['name']);
      $upload = 'upload';
      $txteditor = true;
    }
    $file_name = $file_original_name[0];
    $file_name = preg_replace('!\s+!',"-",$file_name);
    $file_ext = $file_original_name[1];


    if(file_exists('assets/uploads/'.$file_name.'.'.$file_ext)){
      $i = 1;
      while(file_exists('assets/uploads/'.$file_name.'_'.$i.'.'.$file_ext)){
          $i++;
      }
      $file_name_to_upload = $file_name.'_'.$i;
    }else{
      $file_name_to_upload = $file_name;
    }

    $config['file_name'] = $file_name_to_upload;

    $this->load->library('upload', $config);

    if($this->upload->do_upload($upload)){
      $file = $this->upload->data();

      //Create Thumbnails
      if($file['is_image']){

        $this->load->library('image_lib');

        if (!file_exists('assets/uploads/medium')) {
            mkdir('assets/uploads/medium', 0777, true);
        }

        $source_image = $file['file_name'];

          $config['image_library'] = 'gd2';
          $config['source_image'] = "assets/uploads/".$source_image;
        //  $config['create_thumb'] = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']    = 260;
          $config['height']   = 260;
          $config['new_image'] = 'assets/uploads/medium';
          $config['thumb_marker'] = '';
          $this->image_lib->initialize( $config);
          $this->image_lib->resize();

        if (!file_exists('assets/uploads/thumbs')) {
    		    mkdir('assets/uploads/thumbs', 0777, true);
    		}

          $config_thumb['image_library'] = 'gd2';
          $config_thumb['source_image'] = "assets/uploads/".$source_image;
        //  $config_thumb['create_thumb'] = TRUE;
        //  $config_thumb['maintain_ratio'] = TRUE;
          $config_thumb['width']    = 150;
          $config_thumb['height']   = 150;
          $config_thumb['new_image'] = 'assets/uploads/thumbs';
          $config_thumb['thumb_marker'] = '';
          $this->image_lib->initialize( $config_thumb);
          $this->image_lib->resize();




    }
      //Insert media to database

        // a. Get file type
      if($file['is_image'] || $file['file_ext'] == '.svg')
        $data['media_type'] = 'image';
      elseif($file['file_ext'] == '.pdf'){
        $data['media_type'] = 'pdf';
      }else{
        $data['media_type'] = 'other';
      }

        // b. Media name
        $data['media_name'] = $file['file_name'];


      // c. Uploaded date & time
      date_default_timezone_set('Europe/Athens');
      $data['media_uploaded_date'] = date("Y-m-d H:i:s");

      // d.  Insert media's data to databse
      $this->db->insert('media', $data);
      if(!$txteditor)
        echo $this->db->insert_id();
      else
        echo base_url($config['source_image']);
    }


  }

}
