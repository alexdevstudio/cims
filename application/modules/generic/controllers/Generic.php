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


          //$config['protocol'] = 'sendmail';
          $config['smtp_host'] = 'smtp.yourdomain.com';
          $config['smtp_port'] = 465;
          $config['smtp_crypto'] = 'tls';
          $config['smtp_user'] = 'no-reply@yourdomain.com';
          $config['smtp_pass'] = 'youpass';


          $this->load->library('email');
          $this->email->initialize($config);
          $this->email->from('no-reply@yourdomain.com', $_POST['name']);
          $this->email->reply_to($_POST['email'], $_POST['name']);
          $this->email->to('name@yourdomain.com');


          $this->email->subject('Sent via yourdomain.com');
          $this->email->message('Name: '.$_POST['name'].' <br />Phone: '.$_POST['telephone'].' <br />E-mail: <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a> <br />  <hr> '.$_POST['message']);
          if($this->email->send(false))
          echo 'success';
          else
          echo $this->email->print_debugger();
      }


}
