<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic extends MX_Controller{

  public function __construct()
  {
    parent::__construct();

  }



      public function sendEmail()
      {

          $config['charset'] = 'UTF-8';
          $config['wordwrap'] = TRUE;
          $config['mailtype'] = 'html';


          $config['protocol'] = 'sendmail';
          $config['smtp_host'] = 'asmtp.unoeuro.com';
          $config['smtp_port'] = 465;
          $config['smtp_crypto'] = 'tls';
          $config['smtp_user'] = 'no-reply@akupunkturskole.dk';
          $config['smtp_pass'] = 'Booking1234Booking';


          $this->load->library('email');
          $this->email->initialize($config);
          $this->email->from('no-reply@akupunkturskole.dk', $_POST['name']);
          $this->email->reply_to($_POST['email'], $_POST['name']);
          $this->email->to('peter@akupunkturskole.dk');


          $this->email->subject('Besked sendt via akupunkturskole.dk');
          $this->email->message('Navn: '.$_POST['name'].' <br />Telefon: '.$_POST['telephone'].' <br />E-mail: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a> <br />  <hr> '.$_POST['message']);
          if($this->email->send(false))
          echo 'success';
          else
          echo $this->email->print_debugger();
      }

      public function registrationForm()
      {

          $config['charset'] = 'UTF-8';
          $config['wordwrap'] = TRUE;
          $config['mailtype'] = 'html';


          $config['protocol'] = 'sendmail';
          $config['smtp_host'] = 'asmtp.unoeuro.com';
          $config['smtp_port'] = 465;
          $config['smtp_crypto'] = 'tls';
          $config['smtp_user'] = 'no-reply@akupunkturskole.dk';
          $config['smtp_pass'] = 'Booking1234Booking';


          $this->load->library('email');
          $this->email->initialize($config);
          $this->email->from('no-reply@akupunkturskole.dk', $_POST['name']);
          $this->email->reply_to($_POST['email'], $_POST['name']);
          $this->email->to('peter@akupunkturskole.dk');
            // $this->email->to('dokimazw@gmail.com');

          $translation = [
            'uddannelse' => 'Uddannelse',
            'kursus' => 'Kursus',
            'location' => 'Sted og dato',
            'abonnement' => 'Abonnement',
            'name' => 'Navn',
            'address' => 'Adresse',
            'post_nr' => 'Post nr',
            'by' => 'By',
            'telephone' => 'Telefon',
            'email' => 'E-mail',
            'about' => 'Skriv et par ord om dig selv',
            'about1' => 'Hvilke kurser har du deltaget på?',
          ];

          $message = '<table>';
          foreach ($this->input->post() as $key => $value) {
            if($key == 'bot_check' || $key == 'subject' || $key == 'about' || $key == 'about1')
              continue;


            $message .= "<tr><td><strong>".(isset($translation[$key]) ? $translation[$key] : ucfirst($key)).":</strong></td><td>$value</td></tr>";
          }
          $message .= '</table>';

          if(isset($_POST['about'])){
            $message .= "<hr><strong>Skriv et par ord om dig selv:</strong><br>".$this->input->post('about');
          }
          if(isset($_POST['about1'])){
            $message .= "<hr><strong>Hvilke kurser har du deltaget på?:</strong><br>".$this->input->post('about1');
          }
          $this->email->subject($this->input->post('subject'));
          $this->email->message($message);

        //  echo "$message";
          if($this->email->send(false))
          echo 'success';
          else
          echo $this->email->print_debugger();
      }

      function get_courses(){
        //getPostsByCategory($category_id, $order = null, $limit = null)
        $this->db->where('post_category_name', $this->input->post('category_name'));
        $cat = $this->db->get('post_categories')->row();
        if($cat){
          $result = Modules::run('frontend/post/getPostsByCategory', $cat->post_category_id, ['posts.post_created_at', 'ASC']);
          echo json_encode($result);
          return true;
        }
        echo json_encode([]);
        return;
      }
}
