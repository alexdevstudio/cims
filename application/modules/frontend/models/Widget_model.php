<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function letsbegin(){
    return "<h2>Hi there, Awesome Developer!</h2><p>Your HMVC installation is ready. Wish you all the best with your project!</p><p><a href='".base_url('auth')."'>Login Here</a></p>";
  }

}
