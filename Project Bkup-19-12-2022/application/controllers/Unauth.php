<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unauth extends CI_Controller {

 public function index(){
  	$this->is_logged();
  	$data['notificationdata'] = $this->get_notifications();
  	//$this->load->view('unauthorized_viw',$data);
     $this->load->view('common/emp_aside_viw',$data);
  }

 /* public function index(){
    $this->is_logged(3);
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('common/emp_aside_viw',$data);
  }*/


 
  
  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
       $this->load->view('common/emp_aside_viw',$data);
    }
  }	

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }


}