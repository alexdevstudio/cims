<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widget extends MX_Controller{

  public function __construct()
  {
    parent::__construct();
    //$this->output->cache(60);
    $this->load->model('post_model');
  }

  //get posts from category

}
