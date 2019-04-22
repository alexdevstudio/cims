<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends MX_Controller{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('post_model');

  }

  function post_item($language, $post_type, $two = null, $three = null, $four = null, $five = null, $six = null)
  {
        //Check url if it is post, post_type or post_category.

        $language  = (object) $language['language'];
        $post_type = urldecode($post_type);
        $post_type = $this->post_model->getPostItem('post_types',['post_type_slug'=>$post_type, 'post_type_language_id'=>$language->language_id]);
        if($post_type && !$two) {
             return $this->post_type_archive($language, $post_type);
        } elseif($post_type) {
            //if post_type is found, check if second segment is a category_slug
            $two = urldecode($two);
            //$post_category = $this->post_model->getPostItem('post_categories',['post_category_slug' => $two]);
            $this->load->model('frontend_model');
            $post_category = $this->frontend_model->getPostCategory(['post_category_slug' => $two]);
            $post          = $this->post_model->getPostItem('posts',['post_link' => $two, 'post_type' => $post_type->post_type_id, 'post_language' => $language->language_id]);
            // CATEGORY
            if($post_category) {
              // PAGE NUMBER
              if(is_numeric($three) ) {
                 $three = (int) $three;
                 return $this->post_type_category_archive($language, $post_type, $post_category->row(), $three);
              }
              return $this->post_type_category_archive($language, $post_type, $post_category->row());
            // POST
            } elseif($post) {
                //if no category is found, check if second segment is post_link
                return $this->post_type_single_post($language, $post_type, $post);
            // PAGE NUMBER
            } elseif (is_numeric($two) ) {
                $two = (int) $two;
                return $this->post_type_archive($language, $post_type, $two);
            // 404 PAGE
            } else {
                $this->output->set_status_header('404');
                echo "404 - not found";
                exit;
            }
        }

      //if the above is false throw 404
      $this->output->set_status_header('404');
      echo "404 - not found";
      exit;
  }

  private function post_type_archive($language, $post_type, $page_number = 0){

    $offset = $post_type->post_type_posts_per_page * $page_number;
    $total  = count($this->post_model->getPosts(['post_type'=>$post_type->post_type_id, 'post_language'=>$language->language_id]));
    //display category
    $data['item_id'] = $post_type->post_type_id;
    $data['item_type'] = 'post_type';
    $data['page_number'] = $page_number;
    $data['title'] = ($post_type->post_type_custom_h1 != '') ? $post_type->post_type_custom_h1 : $post_type->post_type_name;
    $data['post_type'] = $post_type;

    $data['featured_image'] = ($post_type->post_type_featured_image ? $this->frontend_model->getImage(['media_id'=>$post_type->post_type_featured_image]) : null);

    $data['content'] = $post_type->post_type_text;
    $data['language'] = $language;
    $data['meta_title'] = ($post_type->post_type_meta_title != '') ? $post_type->post_type_meta_title : $data['title'];
    $data['meta_description'] = $post_type->post_type_meta_description;
    $data['meta_keywords'] = $post_type->post_type_meta_keywords;
    $data['posts'] = $this->post_model->getPosts(['post_type'=>$post_type->post_type_id, 'post_language'=>$language->language_id], $post_type->post_type_posts_per_page, $offset);
    $data['lang'] = $language->language_slug;
    $data['base_url'] = ($language->language_default == 1 ? base_url() : base_url($language->language_slug.'/') ) ;
    /************* PAGINATION **********************/
    $this->load->library('pagination');
    $this->pagination->initialize(getPaginatorConfig(
      $post_type->post_type_posts_per_page,
      $offset,
      get_url('post_type', $post_type->post_type_id),
      $total,
      $page_number,
      $language->language_slug
    ));
    /**********************************************/

    //OG Title
    $data['og_title'] = $post_type->post_type_og_title;

    //OG Description
    $data['og_description'] = $post_type->post_type_og_description;

    //OG Image
    $og_image = $this->frontend_model->getImage(['media_id'=>$post_type->post_type_og_image]);
    $data['og_image'] = ($og_image) ? base_url('assets/uploads/'.$og_image->media_name)  : null ;
    if($language->language_default){

      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/post_type';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }else{
      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/post_type';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }
    return ['data' => $data, 'views' => $views];
  }


  private function post_type_category_archive($language, $post_type, $post_category, $page_number = 1){
    $offset = $post_type->post_type_posts_per_page * ($page_number - 1);
    $total  = count($this->post_model->getPostsByCategory($post_category->post_category_id));

    $data['item_id'] = $post_category->post_category_id;
    $data['item_type'] = 'post_category';
    $data['title'] = ($post_category->post_category_custom_h1 != '') ? $post_category->post_category_custom_h1 : $post_category->post_category_name;
    $data['post_type'] = $post_type;
    $data['post_category'] = $post_category;
    $data['content'] = $post_category->post_category_text;
    $data['language'] = $language;
    $data['meta_title'] = ($post_category->post_category_meta_title != '') ? $post_category->post_category_meta_title : $data['title'];
    $data['meta_description'] = $post_category->post_category_meta_description;
    $data['meta_keywords'] = $post_category->post_category_meta_keywords;
    $data['lang'] = $language->language_slug;
    $data['posts'] = $this->post_model->getPostsByCategory($post_category->post_category_id, ['post_title', 'ASC'], $post_type->post_type_posts_per_page, $offset);
    $data['base_url'] = ($language->language_default == 1 ? base_url() : base_url($language->language_slug.'/') ) ;

    /************* PAGINATION **********************/
    $this->load->library('pagination');
    $this->pagination->initialize(getPaginatorConfig(
      $post_type->post_type_posts_per_page,
      $offset,
      get_url('post_category', $post_category->post_category_id),
      $total,
      $page_number,
      $language->language_slug
    ));
    /**********************************************/

    //OG Title
    $data['og_title'] = $post_category->post_category_og_title;

    //OG Description
    $data['og_description'] = $post_category->post_category_og_description;

    //OG Image
    $og_image = $this->frontend_model->getImage(['media_id'=>$post_category->post_category_og_image]);
    $data['og_image'] = ($og_image) ? base_url('assets/uploads/'.$og_image->media_name)  : null ;

    if($language->language_default){
      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/category';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }else{
      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/category';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }

    return ['data' => $data, 'views' => $views];
  }


  private function post_type_single_post($language, $post_type, $post){

    $data['item_id'] = $post->post_id;
    $data['item_type'] = 'post';
    $data['title'] = ($post->post_custom_h1 != '') ? $post->post_custom_h1 : $post->post_title;
    $data['post_type'] = $post_type;
    $data['post_categories'] = $this->post_model->getPostCategories($post->post_id);
    $data['content'] = $post->post_text;
    $data['language'] = $language;
    $data['meta_title'] = ($post->post_meta_title == '') ? $data['title'] : $post->post_meta_title;
    $data['meta_description'] = $post->post_meta_description;
    $data['meta_keywords'] = $post->post_meta_keywords;
    $data['lang'] = $language->language_slug;
    $data['post'] = $post;
    $data['post_image'] = $this->frontend_model->getImage(['media_id'=>$post->post_image]);
    $data['base_url'] = ($language->language_default == 1 ? base_url() : base_url($language->language_slug.'/') ) ;
    //OG Title
    $data['og_title'] = $post->og_meta_title;

    //OG Description
    $data['og_description'] = $post->og_meta_description;

    //OG Image
    $og_image = $this->frontend_model->getImage(['media_id'=>$post->og_meta_image]);
    if(!$og_image)
    $og_image = $data['post_image'];

    $data['og_image'] = ($og_image) ? base_url('assets/uploads/'.$og_image->media_name)  : null ;

    if($language->language_default){
      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/single_post';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }else{
      $views[] = 'templates/'.$language->language_slug.'/header';
      $views[] = 'posts/'.$language->language_slug.'/'.$post_type->post_type_file_name.'/single_post';
      $views[] = 'templates/'.$language->language_slug.'/footer';
    }
    return ['data' => $data, 'views' => $views];
  }


    public function getRelatedPosts($categories, $post, $limit){
        return $this->post_model->getRelatedPosts($categories, $post, $limit);

    }

    public function latestPosts($language_slug, $post_type_slug, $category,  $limit){
      return $this->post_model->latestPosts($language_slug, $post_type_slug, $category,  $limit);
    }

    public function getPostsByCategory($category_id, $order = null, $limit = null, $offset = null){
      return $this->post_model->getPostsByCategory($category_id, $order, $limit, $offset);
    }

//

}
