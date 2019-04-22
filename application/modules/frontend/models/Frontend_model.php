<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getPage($where){
    $this->db->where($where);
    $this->db->limit(1);
    $this->db->join('languages','pages.page_language = languages.language_id');
    $item = $this->db->get('pages');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }

  public function getPost($where){
    $this->db->where($where);
    $this->db->limit(1);
    $this->db->join('languages','posts.post_language = languages.language_id');
    $this->db->join('post_types','posts.post_type = post_types.post_type_id', 'right');
    $this->db->join('media as post_image','posts.post_image = post_image.media_id', 'left');
    $this->db->join('media as og_meta_image','posts.og_meta_image = og_meta_image.media_id', 'left');
    $item = $this->db->get('posts');

    if($item->num_rows() > 0){

      return $item;
    }

    return;
  }

  public function getCustomFieldsForPostType($post_type_id){
    $this->db->where(['custom_field_post_type_id' => $post_type_id]);
    $item = $this->db->get('custom_fields');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }

  public function getPostCategory($where){
    $this->db->where($where);
    $this->db->limit(1);
    $this->db->join('languages','post_categories.post_category_language = languages.language_id');
    $this->db->join('post_types','post_categories.post_category_post_type = post_types.post_type_id');
    $this->db->join('media as featured_image','post_categories.post_category_featured_image = featured_image.media_id', 'left');
    $item = $this->db->get('post_categories');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }


  public function getPostCategories($where, $order = null){

    $this->db->where($where);
    $this->db->join('languages','post_categories.post_category_language = languages.language_id');
    $this->db->join('media','post_categories.post_category_featured_image = media.media_id', 'left');
    if(!$order)
      $this->db->order_by('post_categories.post_category_created_at', 'DESC');
    else
        $this->db->order_by($order[0], $order[1]);

    $items = $this->db->get('post_categories');

    if($items->num_rows() > 0){
      return $items->result();
    }
    return;
  }

  public function getPostType($where){
    $this->db->where($where);
    $this->db->limit(1);
    $this->db->join('languages','post_types.post_type_language_id = languages.language_id');
    $this->db->join('media as featured_image','post_types.post_type_featured_image = featured_image.media_id', 'left');
    $this->db->join('media as og_image','post_types.post_type_featured_image = og_image.media_id', 'left');
    $item = $this->db->get('post_types');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }

  public function getCustomFields($post_id){
    $this->db->where('custom_field_relation.custom_field_relation_post_id', $post_id);
    $this->db->join('custom_fields','custom_field_relation.custom_field_relation_custom_field_id = custom_fields.custom_field_id');
    $item = $this->db->get('custom_field_relation');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }

  public function getCustomFieldsWhere($where){
    $this->db->where($where);
    $this->db->join('custom_fields','custom_field_relation.custom_field_relation_custom_field_id = custom_fields.custom_field_id');
    $item = $this->db->get('custom_field_relation');

    if($item->num_rows() > 0){
      return $item;
    }

    return;
  }

  public function getImage($where){
    $this->db->where($where);
    $media = $this->db->get('media');

    if($media->num_rows() > 0){
      return $media->row();
    }

    return;
  }



  public function getLanguage($where = null){

    if($where)
    $this->db->where($where);

    $language = $this->db->get('languages');

    if($language->num_rows() > 0){
      return $language->row();
    }

    return;
  }

  public function getDefaultMeta(){
    $default_meta = $this->db->get('default_meta');

    if($default_meta->num_rows() > 0){
      return $default_meta;
    }

    return;
  }

  public function getMedia($media_id){
    $this->db->where('media_id', $media_id);
    return $this->db->get('media')->row();
  }



}
