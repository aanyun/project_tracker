<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $this->load->helper(array('form'));
   // redirect('index', 'refresh');
   $this->load->view('login_view');
   // $content = $this->load->view('login_view',null,true);
   // $this->render($content);
 }

}

?>