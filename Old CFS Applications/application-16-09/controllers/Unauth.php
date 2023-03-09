<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unauth extends CI_Controller {

  public function index(){
  	$this->is_logged();
  	$this->load->view('unauthorized_viw');
  }

 
  
  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
    }
  }	


}