<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }


  function getPost($id){
    $this->db->where('post_id', $id);
    $post = $this->db->get('posts');

    if($post->num_rows() > 0)
      return $post->result();
    else
      return;
  }


  function getPostType($id){
    $this->db->where('post_types.post_type_id', $id);
    $this->db->join('languages', 'post_types.post_type_language_id = languages.language_id');
    $this->db->join('media', 'post_types.post_type_featured_image = media.media_id', 'left');
    $item = $this->db->get('post_types');
    if($item->num_rows() > 0)
      return $item->row();

      return;
  }



}
