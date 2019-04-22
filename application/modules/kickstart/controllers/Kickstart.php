<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kickstart extends MX_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

    if($this->ion_auth->logged_in())
    {
      //list the users
      $data['users'] = $this->ion_auth->users()->result();
      foreach ($data['users'] as $k => $user)
      {
        $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
      }
      $this->load->view('templates/admin/header', $data);
      $this->load->view('main', $data);
      $this->load->view('templates/admin/footer', $data);

    //  $this->_render_page('/auth/index', $data);
    }else {
      $this->load->model('kickstart_model');
      $data['kickstart'] = $this->kickstart_model->letsbegin();

      $this->load->view('index', $data);
    }


  }

}
