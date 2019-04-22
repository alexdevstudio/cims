<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  //$arrgs is an array that can hold diffirent clomun names for language table
  function getImages($arrgs = null){

    if($arrgs){
      foreach ($arrgs as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    $images = $this->db->get('media');

    if($images->num_rows() > 0)
      return $images->result();
    else
      return;
  }

  function getCategories($arrgs = null){

    if($arrgs){
      foreach ($arrgs as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    $categories = $this->db->get('post_categories');

    if($categories->num_rows() > 0)
      return $categories->result();
    else
      return;
  }


  function getUserData($id){
    $this->db->where('id', $id);
    $user = $this->db->get('users');

    if($user->num_rows() > 0)
      return $user->result();
    else
      return;
  }


  function getImage($image_name){
    $this->db->where('media_name', $image_name);
    $user = $this->db->get('media');

    if($user->num_rows() > 0)
      return $user->result();
    else
      return;
  }


  function getLanguage($where){
    if($where)
    $this->db->where($where);
    $user = $this->db->get('languages');

    if($user->num_rows() > 0)
      return $user->row();
    else
      return;
  }

  function getPostType($where){
    if($where)
    $this->db->where($where);
    $post_type = $this->db->get('post_types');

    if($post_type->num_rows() > 0)
      return $post_type->row();
    else
      return;
  }



}
