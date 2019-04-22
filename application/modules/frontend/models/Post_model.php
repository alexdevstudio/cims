<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getPosts($where, $limit = null, $offset = null, $order_by = null){
    $this->db->where($where);

    $this->db->join('media', 'posts.post_image = media.media_id', 'left');

    if($order_by){
        foreach ($order_by as $key => $value) {
              $this->db->order_by($key, $value);
        }
    }else{
      $this->db->order_by('post_created_at', 'DESC');
    }

    $post_item = $this->db->get('posts', $limit, $offset);

    if($post_item->num_rows() > 0){
      return $post_item->result();
    }

    return;
  }

  public function getPostsWhereIn($field, $array, $limit = null, $offset = null, $order_by = null){
    $this->db->where_in($field, $array);

    $this->db->join('media', 'posts.post_image = media.media_id', 'left');

    if($order_by){
        foreach ($order_by as $key => $value) {
              $this->db->order_by($key, $value);
        }
    }else{
      $this->db->order_by('post_created_at', 'DESC');
    }

    $post_item = $this->db->get('posts', $limit, $offset);

    if($post_item->num_rows() > 0){
      return $post_item->result();
    }

    return;
  }

  public function getPostsByCategory($category_id, $order = null, $limit = null, $offset = null){
    $this->db->where(['post_category_relation.post_category_id' => $category_id]);
    $this->db->join('post_category_relation', 'post_category_relation.post_id = posts.post_id', 'inner');
    $this->db->join('media', 'media.media_id = posts.post_image', 'left');
    //Default order show's most recent first
    if($order){
      $this->db->order_by($order[0], $order[1]);
    } else {
      $this->db->order_by('posts.post_created_at', 'DESC');
    }
    //Limit the number of posts
    $this->db->limit($limit, $offset);
    $post_item = $this->db->get('posts');
    if($post_item->num_rows() > 0){
      return $post_item->result();
    }
    return;
  }


  public function getPostCategories($post_id){
    $this->db->where(['post_category_relation.post_id' => $post_id]);
    $this->db->join('post_categories', 'post_category_relation.post_category_id = post_categories.post_category_id');
    $post_item = $this->db->get('post_category_relation');

    if($post_item->num_rows() > 0){
      return $post_item->result();
    }

    return;
  }



  public function getPostItem($table, $where){

    $this->load->model('frontend_model');
    $post = $this->frontend_model->getPost($where);

    if( $post )
      return $post->row();

    return;

  }

  public function getLanguage($where = null){

    if($where)
    $this->db->where($where);

    $language = $this->db->get('languages');

    if($language->num_rows() > 0){
      return $language->result();
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

  public function getRelatedPosts($categories, $post, $limit){
    $related_posts = [];
    $i = 0;
    foreach ($categories as $category) {

      $temp_limit = $limit - $i;
      $posts = $this->db->query("SELECT * FROM `post_category_relation`
                              JOIN `posts` ON `posts`.`post_id` = `post_category_relation`.`post_id`
                              JOIN `media` ON `posts`.`post_image` = `media`.`media_id`
                              WHERE `post_category_relation`.`post_category_id` = '$category->post_category_id'
                              AND `posts`.`post_language` = '$post->post_language'
                              AND `post_category_relation`.`post_id` != '$post->post_id'
                              ORDER BY TIMEDIFF( posts.post_created_at , '$post->post_created_at') DESC LIMIT $temp_limit");
      $related_posts = array_merge($related_posts, $posts->result_array());
      if(count($related_posts) >= $limit){
        break;
      }else{
        $i = $limit - count($related_posts);
      }

    }

   return $related_posts;
  }


  public function latestPosts($language_slug, $post_type_slug, $category,  $limit){

      $language = $this->getLanguage(['language_slug'=>$language_slug])[0];



      $latest_posts = $this->db->query("SELECT * FROM post_types
                              JOIN posts ON posts.post_type = post_types.post_type_id
                              JOIN media ON posts.post_image = media.media_id
                              WHERE post_types.post_type_slug = '$post_type_slug'
                              AND posts.post_language = $language->language_id
                              ORDER BY posts.post_created_at DESC LIMIT $limit");

      if($latest_posts->num_rows() > 0)
       return $latest_posts->result();


    return;
  }


}
