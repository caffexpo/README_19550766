<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index(){
  	$this->is_logged();
  	if($this->session->userdata('org_type')==2){
  		$orgid = $this->session->userdata('org_id');
  		$data['org_count'] = 1;
  	    $data['emp_count'] = $this->common_model->get_emp_count($orgid,2);
  	    $data['project_count'] = $this->common_model->get_proj_count($orgid,2);
  	    $data['event_count'] = $this->common_model->get_event_count($orgid,2);
  	}else{
  		$orgid = "";
  		$data['org_count'] = $this->common_model->get_org_count();
  	    $data['emp_count'] = $this->common_model->get_emp_count($orgid,1);
  	    $data['project_count'] = $this->common_model->get_proj_count($orgid,1);
  	    $data['event_count'] = $this->common_model->get_event_count($orgid,1);
  	}
  	
  	$this->load->view('dashboard_viw',$data);
  }

  

  
  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
    }
  }	


}







