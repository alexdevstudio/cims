<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends MX_Controller{

  public function __construct()
  {
    parent::__construct();
    if ( ! $this->ion_auth->logged_in())
    {
      //$this->output->cache(2800); //2 days
    }

    $this->load->model('frontend_model');
  }

  function index($one=null, $two=null, $three=null, $four=null, $five=null, $six=null)
  {
    if($one){
      //Check if language is specified
      $language = $this->frontend_model->getLanguage(['language_slug'=>$one]);
      if($language)
      {
          //if language is default then redirect to the URL without language_slug
          if($language->language_default == 1)
          {
            redirect(base_url());
          }else{
            $this->language($one, $two, $three, $four, $five, $six);
          }
          return true;
      }
    }

    $language = $this->frontend_model->getLanguage(['language_default'=>'1']);
    $language_id = $language->language_id;
    $lang = $default_language = $language->language_slug;



      //Initialize data
      $data = [];

      if(!$one)
        $uri = 'home';
      else{
        $uri = urldecode(uri_string());
        $uri_arr = explode('/', $uri);
        $uri = $uri_arr[count($uri_arr) - 1];
      }


        //Get the page
        $page = $this->frontend_model->getPage(['pages.page_link'=>$uri,'pages.page_language'=>$language_id]);

        //If no page was found then check if URL in tables: post, post_type, post_category
        //first variable is array, to avoid default language check again
        if(!$page){

          //if no page found then $one variable should be post_type
          $post_type = $one;
          $language = ['language' => $language];

          //Return post data and display
          $post_data = Modules::run('frontend/post/post_item',$language, $post_type, $two, $three, $four, $five, $six);
          $i = 0;


          foreach ($post_data['views'] as $view) {
            if($i < 1)
              $this->load->view($view, $post_data['data']);
            else
              $this->load->view($view);

            $i++;
          }
          return;
        }

        $page = $page->row();

        $data['item_id'] = $page->page_id;
        $data['item_type'] = 'page';

        //Language attribute
        $data['lang'] = $language->language_slug;

        //Title
        $data['meta_title'] = ($page->page_meta_title != '' ? $page->page_meta_title : $page->page_title);

        //Description
        $data['meta_description'] = $page->page_meta_description;

        //Keywords
        $data['meta_keywords'] = $page->page_meta_keywords;

        //OG Title
        $data['og_title'] = $page->page_og_title;

        //OG Description
        $data['og_description'] = $page->page_og_description;

        //OG Image
        $og_image = $this->frontend_model->getImage(['media_id'=>$page->page_og_image]);

        $data['og_image'] = ($og_image) ? get_src( $og_image->media_name ) : null ;

        //Link
        $data['page_link'] = $page->page_link;

        //Page title
        $data['title'] = ($page->page_custom_h1 != '' ? $page->page_custom_h1  : $page->page_title);

        //Content
        $data['content'] = $page->page_content;

        //base_url
        $data['base_url'] = base_url();


        $this->load->view('templates/'.$lang.'/header', $data);
        $this->load->view('pages/'.$data['lang'].'/'.$page->page_template_file);
        $this->load->view('templates/'.$lang.'/footer');

  }

  private function language ($lang, $one=null, $two=null, $three=null, $four=null, $five=null)
  {

      $language = $this->frontend_model->getLanguage(['language_slug'=>$lang]);
      $language_id = $language->language_id;
      $default_language = $language->language_slug;

      //Initialize data
      $data = [];

      if(!$one)
        $uri = 'home';
      else
        $uri = urldecode(uri_string());

        $uri = ltrim($uri, $lang.'/');
        //Get the page
        $page = $this->frontend_model->getPage(['pages.page_link'=>$uri,'pages.page_language'=>$language_id]);

        if(!$page){
          //if no page found then $one variable should be post_type
          $post_type = $one;
          $language = ['language'=>['default'=>false,'slug'=>$lang]];

          $post_data = Modules::run('frontend/post/post_item',$language, $post_type, $two, $three, $four, $five);
          $i = 0;
          foreach ($post_data['views'] as $view) {
            if($i < 1)
              $this->load->view($view, $post_data['data']);
            else
              $this->load->view($view);

            $i++;
          }
          return;
        }

        $page = $page->row();

        //Add map to contact page
        //Contact page's ID is 274
        $data['item_id'] = $page->page_id;
        $data['item_type'] = 'page';

        //Language attribute
        $data['lang'] = $lang;

        //Title
        $data['meta_title'] = ($page->page_meta_title != '' ? $page->page_meta_title : $page->page_title);

        //Description
        $data['meta_description'] = $page->page_meta_description;

        //Keywords
        $data['meta_keywords'] = $page->page_meta_keywords;

        //OG Title
        $data['og_title'] = $page->page_og_title;

        //OG Description
        $data['og_description'] = $page->page_og_description;

        //OG Image
        $og_image = $this->frontend_model->getImage(['media_id'=>$page->page_og_image]);

        $data['og_image'] = ($og_image) ? base_url('assets/uploads/'.$og_image->media_name)  : null ;

        //Link
        $data['page_link'] = $page->page_link;

        //Page title
        $data['title'] = ($page->page_custom_h1 != '' ? $page->page_custom_h1  : $page->page_title);

        //Content
        $data['content'] = $page->page_content;

        //base_url
        $data['base_url'] = base_url($lang);

        $this->load->view('templates/'.$lang.'/header', $data);
        $this->load->view('pages/'.$data['lang'].'/'.$page->page_template_file);
        $this->load->view('templates/'.$lang.'/footer');

    }


      public function redirect404(){
        $this->output->set_status_header('404');
		      echo "404 - not found";
      }

      public function getMedia($media_id){
        return $this->frontend_model->getMedia($media_id);

      }
      public function sendEmail($name, $email, $subject, $phone)
      {
        $arr = [$name, $email, $subject, $phone];
        echo json_encode($arr);
      }

      public function getShareButtons($post_url, $post_title){
        return $this->frontend_model->getShareButtons($post_url, $post_title);
      }


}
