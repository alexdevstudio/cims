<?php


//Get item's url by type and id
function get_url($type, $id){
  return call_user_func('get_url_'.$type, $id);
}

//Get the url of a page
function get_url_page($id){


  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPage(['page_id' => $id]);
  if( ! $item)
    return base_url();
  else
    $item = $item->row();

  $depth = $item->page_depth_level;
  $parent_id = $item->page_parent_page_id;
  $parents = [$item->page_link];

  while ($depth > 0) {
    $parent_page = $CI->frontend_model->getPage(['page_id' => $parent_id]);

    if( ! $parent_page)
      $parents[] = $parent_id.'-no_such_page';
    else{
      $parents[] = $parent_page->row()->page_link;
      $depth = $parent_page->row()->page_depth_level;
      $parent_id = $parent_page->row()->page_parent_page_id;
    }

  }

  $url = '';
  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/';

  //Run the loop from $parents array to build the url
  for ($i = count($parents) - 1; $i >= 0 ; $i--) {
    $url .= $parents[$i].'/';
  }
  $url = rtrim($url, '/');
  return base_url($url);
}

//Get the url of a post type
function get_url_post_type($id){

  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostType(['post_type_id' => $id]);
  if( ! $item)
    return base_url();
  else
    $item = $item->row();

  $url = $item->post_type_slug;

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/'.$url;

  return base_url($url);
}


//Get the url of a post category
function get_url_post_category($id){

  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostCategory(['post_category_id' => $id]);
  if( ! $item)
    return base_url();
  else
    $item = $item->row();

  $url = $item->post_type_slug.'/'.$item->post_category_slug;

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/'.$url;

  return base_url($url);
}

//Get the url of a post
function get_url_post($id){

  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPost(['post_id' => $id]);
  if( ! $item)
    return base_url();
  else
    $item = $item->row();

  $url = $item->post_type_slug.'/'.$item->post_link;

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/'.$url;

  return base_url($url);
}

//Get item's content
function get_item($type, $id){
  return call_user_func('get_item_'.$type, $id);
}

//Get item page
function get_item_page($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPage(['page_id' => $id]);
  if( ! $item)
    return base_url();

    return $item->row();

}
//Get item post type
function get_item_post_type($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostType(['post_type_id' => $id]);
  if( ! $item)
    return base_url();

    return $item->row();
}
//Get item post category
function get_item_post_category($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostCategory(['post_category_id' => $id]);
  if( ! $item)
    return base_url();

    $item->row()->content = $item->row()->post_category_text;
    return $item->row();
}
//Get item post
function get_item_post($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPost(['post_id' => $id]);
  if( ! $item)
    return base_url();

    return $item->row();
}

function content($content = null){
  $content = str_replace('&nbsp;', ' ', $content);
  return $content;
}

// get breadcrumbs
function get_breadcrumbs($type, $id){
  return call_user_func('get_breadcrumbs_for_'.$type, $id);
}



function get_breadcrumbs_for_page($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $page = $CI->frontend_model->getPage(['page_id' => $id]);
  if( ! $page)
    return false;
  else
    $page = $page->row();

  $depth = $page->page_depth_level;
  $parent_id = $page->page_parent_page_id;
  $page_title = $page->page_title;//($page->page_custom_h1 == '') ? $page->page_title : $page->page_custom_h1;
  $parents[] = ['title' => $page_title, 'link' => ''];

  $url = '';
  //Check if th language is not the default to insert the slug into url
  if($page->language_default != 1)
    $url = $page->language_slug.'/';

  while ($depth > 0) {
    $parent_page = $CI->frontend_model->getPage(['page_id' => $parent_id]);

    if( ! $parent_page)
      $parents[] = ['link' => '#', 'title' => 'No Such Page'];
    else{
      $parent_page_title = ($parent_page->row()->page_custom_h1 == '') ? $parent_page->row()->page_title : $parent_page->row()->page_custom_h1;

      $parents[] = ['link' => $parent_page->row()->page_link, 'title' => $parent_page_title];
      $depth = $parent_page->row()->page_depth_level;
      $parent_id = $parent_page->row()->page_parent_page_id;
    }
  }
  return $parents;

}

function get_breadcrumbs_for_post_type($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostType(['post_type_id' => $id]);
  if( ! $item)
    return false;
  else
    $item = $item->row();

  $item_title = $item->post_type_name;//($item->post_type_custom_h1 != '') ? $item->post_type_custom_h1 : $item->post_type_name;

  $url = $item->post_type_slug;

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/'.$url;

  $items[] = ['link' => $url, 'title' => $item_title];

  return $items;

}

function get_breadcrumbs_for_post_category($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPostCategory(['post_category_id' => $id]);

  if( ! $item)
    return false;
  else
    $item = $item->row();

  $post_type = $CI->frontend_model->getPostType(['post_type_id' => $item->post_category_post_type]);
  if( ! $post_type)
    return false;
  else
    $post_type = $post_type->row();

  $item_title = $item->post_category_name;//($item->post_category_custom_h1 != '') ? $item->post_category_custom_h1 : $item->post_category_name; //
  $url = '';

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/';

    $items[] = ['link' => '', 'title' => $item_title];
    $post_type_title = ($post_type->post_type_custom_h1 != '') ? $post_type->post_type_custom_h1 : $post_type->post_type_name;
    $items[] = ['link' => $url.$post_type->post_type_slug, 'title' => $post_type_title];

  return $items;

}

function get_breadcrumbs_for_post($id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $item = $CI->frontend_model->getPost(['post_id' => $id]);

  if( ! $item)
    return false;
  else
    $item = $item->row();

  $post_type = $CI->frontend_model->getPostType(['post_type_id' => $item->post_type]);
  if( ! $post_type)
    return false;
  else
    $post_type = $post_type->row();

  $item_title = $item->post_title;//($item->post_custom_h1 != '') ? $item->post_custom_h1 : $item->post_title;
  $url = '';

  //Check if th language is not the default to insert the slug into url
  if($item->language_default != 1)
    $url = $item->language_slug.'/';

    $items[] = ['link' => '', 'title' => $item_title];
    $post_type_title = ($post_type->post_type_custom_h1 != '') ? $post_type->post_type_custom_h1 : $post_type->post_type_name;
    $items[] = ['link' => $url.$post_type->post_type_slug, 'title' => $post_type_title];

  return $items;

}


//Get Categories of a specific post_type

function getPostCategories($selector = null, $order = null){
  if(!$selector)
    return;

  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
      if( ! is_int ($selector) ){
        $CI->db->where('post_type_name', $selector);
        $CI->db->limit(1);
        $post_type = $CI->db->get('post_types');

        if($post_type->num_rows() > 0){
          $post_type = $post_type->row();
          $selector = $post_type->post_type_id;
        }else{
          return false;
        }
      }

  $where = ['post_categories.post_category_post_type' => $selector];

  $categories = $CI->frontend_model->getPostCategories($where, $order);

  return $categories;



}



//Get all custom fields for a post

function getCustomFields($post_id){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $custom_fields = $CI->frontend_model->getCustomFields($post_id);

  if($custom_fields)
    return $custom_fields->result();

    return;
}

function getCustomFieldsWhere($where){
  $CI = get_instance();
  $CI->load->model('frontend/frontend_model');
  $custom_fields = $CI->frontend_model->getCustomFieldsWhere($where);

  if($custom_fields)
    return $custom_fields->result();

    return;
}


function get_src($image_name, $image_size = null){
  $size = '';
  if($image_size)
    $size = $image_size.'/';

    return base_url('assets/uploads/'.$size.$image_name);

}

function get_assets(){
    return base_url('assets/frontend/');
}


function isIphone($user_agent=NULL) {
    if(!isset($user_agent)) {
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
    return (strpos($user_agent, 'iPhone') !== FALSE);
}

function getPosts($where, $limit = null, $offset = null, $order_by = null ){
    $CI = get_instance();
    $CI->load->model('post_model');
    return $CI->post_model->getPosts($where, $limit, $offset, $order_by);
}
function getPostsWhereIn($field, $array, $limit = null, $offset = null, $order_by = null ){
    $CI = get_instance();
    $CI->load->model('post_model');
    return $CI->post_model->getPostsWhereIn($field, $array, $limit, $offset, $order_by);
}

/**
 * [getPaginatorConfig description]
 * @param  int $posts_per_page the number of the posts per page
 * @param  int $offset  offset
 * @param  int $root_url  base url for the posts page
 * @param  int $total_rows  total rows in result set
 * @param  int $page_number  current page number
 * @param  string $language  language "gr"|"en"
 * @param  int $options options
 * @return array config for pagination
 */
function getPaginatorConfig($posts_per_page, $offset, $root_url, $total_rows, $page_number, $language, $options = null){
  $config = [];
  $config['limit']            = $posts_per_page;
  $config['offset']           = $offset;
  $config['per_page']         = $posts_per_page;
  $config['base_url']         = $root_url;
  $config['total_rows']       = $total_rows;
  $config['use_page_numbers'] = true;
  $config['full_tag_open']    = '<ul class="pagination-custom">';
  $config['full_tag_close']   = '</ul>';
  $config['first_link']       = $language == 'gr' ? 'Αρχή'  : 'First';
  $config['last_link']        = $language == 'gr' ? 'Τέλος' : 'Last';
  $config['first_tag_open']   = '<li class="page-item">';
  $config['first_tag_close']  = '</li>';
  $config['last_tag_open']    = '<li class="page-item">';
  $config['last_tag_close']   = '</li>';
  $config['next_tag_open']    = '<li class="page-item">';
  $config['next_tag_close']   = '</li>';
  $config['prev_tag_open']    = '<li  class="page-item">';
  $config['prev_tag_close']   = '</li>';
  $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="'.$root_url.'/'.$page_number.'">';
  $config['cur_tag_close']    = '</a></li>';
  $config['num_tag_open']     = '<li class="page-item">';
  $config['num_tag_close']    = '</li>';
  $config['attributes']     = ['class' => 'page-link'];

  return $config;
}

function cleanHTML($string){
  $string = strip_tags($string, '<p><br><b><img><ul><li><ol><h1><h2><h3><h4><h5><h6><table><strong>');
  $string = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $string);
  $string = str_replace('<h1>', '<h2>', $string);
  $string = str_replace('</h1>', '</h2>', $string);
  $string = str_replace('<h4>', '<h3>', $string);
  $string = str_replace('</h4>', '</h3>', $string);
  $string = str_replace('</h1>', '', $string);
  $string = str_replace('<p> </p>', '', $string);
  $string = str_replace('<p>&nbsp;</p>', '', $string);
  $string = preg_replace("/&nbsp;/",' ',$string);//<p>&nbsp;</p>

  return htmlspecialchars_decode($string);
}

function contact_details($key){
  $array = [
    'email' => 'peter@akupunkturskole.dk',
    'address' => 'Niels W. Gades Kvt. 13, 9700, Brønderslev',
    'phone' => '+45 42737114',
    'phone2' => '',
    'mobile' => '',
    'facebook' => 'https://www.facebook.com/akupunkturskole/',
    'twitter' => 'https://twitter.com/#',
    'youtube' => 'https://www.youtube.com/#',
    'instagram' => 'https://www.instagram.com/akupunkturskole/',
  ];
    return (isset($array[$key]) ?  $array[$key] : null);

}



  function getShareButtons($post_url, $post_title){
    return '<div class="social-links">
                  <h4>Del:</h4>
                  <ul>
                  <li>
                    <a href="mailto:?Subject=Page%20Share:%20'.urlencode($post_title).'&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 '.urlencode($post_url).'" rel="noreferrer" >
                      <span class="fa fa-envelope"></span>
                    </a>
                  </li>
                    <li>
                      <a href="http://www.facebook.com/sharer.php?u='.urlencode($post_url).'"  rel="noreferrer" target="_blank">
                        <span class="fa fa-facebook"></span>
                      </a>
                      </li>
                    <li>
                      <a href="https://twitter.com/share?url='.urlencode($post_url).'&amp;text='.urlencode($post_title).'"  rel="noreferrer" target="_blank">
                        <span class="fa fa-twitter"></span>
                      </a>
                    </li>
                    <li>
                      <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.urlencode($post_url).'" rel="noreferrer" target="_blank">
                        <span class="fa fa-linkedin"></span>
                      </a>
                    </li>
                  </ul>
                </div>';
  }

function copyImg($source, $fileName)
{
 require APPPATH.'vendor/autoload.php';
 // import the Intervention Image Manager Class
 //use Intervention\Image\ImageManager;

 // create an image manager instance with favored driver
 $manager = new Intervention\Image\ImageManager(['driver' => 'imagick']);

 $img = $manager->make(get_src( $source ));

$img->save('assets/uploads/'.$fileName);
$img->resize(260, null, function ($constraint) {
   $constraint->aspectRatio();
});
$img->save('assets/uploads/medium/'.$fileName);
$img->resize(150, null, function ($constraint) {
   $constraint->aspectRatio();
});
$img->save('assets/uploads/thumbs/'.$fileName);

$CI = get_instance();

$data['media_type'] = 'image';
$data['media_name'] = $fileName;
$data['media_uploaded_date'] = date("Y-m-d H:i:s");
$CI->db->insert('media', $data);
$imgId = $CI->db->insert_id();


return $CI->db->get_where('media', ['media_id'=>$imgId])->row();
}
 function createImg($city, $fileName, $postId)
{
  require APPPATH.'vendor/autoload.php';
  // import the Intervention Image Manager Class
  //use Intervention\Image\ImageManager;

  // create an image manager instance with favored driver
  $manager = new Intervention\Image\ImageManager(['driver' => 'imagick']);

  $img = $manager->make(get_src( 'blank-gradient.jpg' ));

// to finally create image instances
$img->text($city, 425,240, function($font) {
  $font->file('assets/frontend/fonts/OpenSans-Bold.ttf');
  $font->size(80);
  $font->color('#ffffff');
  $font->align('center');
});
$img->save('assets/uploads/'.$fileName.'.jpg');
$img->resize(260, null, function ($constraint) {
    $constraint->aspectRatio();
});
$img->save('assets/uploads/medium/'.$fileName.'.jpg');
$img->resize(150, null, function ($constraint) {
    $constraint->aspectRatio();
});
$img->save('assets/uploads/thumbs/'.$fileName.'.jpg');

$CI = get_instance();

$data['media_type'] = 'image';
$data['media_name'] = $fileName.'.jpg';
$data['media_uploaded_date'] = date("Y-m-d H:i:s");
$CI->db->insert('media', $data);
$imgId = $CI->db->insert_id();

$postData = ['post_image' => $imgId];
$CI->db->where('post_id', $postId);
$CI->db->update('posts', $postData);

return $CI->db->get_where('media', ['media_id'=>$imgId])->row();
}


function createTagImg($city, $fileName, $postId, $sample)
{

 require APPPATH.'vendor/autoload.php';
 // import the Intervention Image Manager Class
 //use Intervention\Image\ImageManager;

 // create an image manager instance with favored driver
 $manager = new Intervention\Image\ImageManager(['driver' => 'imagick']);

 $img = $manager->make(get_src( $sample ));

// to finally create image instances
$img->text($city, 425,270, function($font) {
 $font->file('assets/frontend/fonts/OpenSans-Bold.ttf');
 $font->size(80);
 $font->color('#ffffff');
 $font->align('center');
});
$img->save('assets/uploads/'.$fileName.'.jpg');
$img->resize(260, null, function ($constraint) {
   $constraint->aspectRatio();
});
$img->save('assets/uploads/medium/'.$fileName.'.jpg');
$img->resize(150, null, function ($constraint) {
   $constraint->aspectRatio();
});
$img->save('assets/uploads/thumbs/'.$fileName.'.jpg');

$CI = get_instance();

$data['media_type'] = 'image';
$data['media_name'] = $fileName.'.jpg';
$data['media_uploaded_date'] = date("Y-m-d H:i:s");
$CI->db->insert('media', $data);
$imgId = $CI->db->insert_id();

$postData = ['post_image' => $imgId];
$CI->db->where('post_id', $postId);
$CI->db->update('posts', $postData);

return $CI->db->get_where('media', ['media_id'=>$imgId])->row();
}
