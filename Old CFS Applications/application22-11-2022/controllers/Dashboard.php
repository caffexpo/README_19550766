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
        $data['project_count1'] = $this->common_model->get_proj_count1($orgid,2);
        //print($data['project_count1']);
        $data['pendings'] = $this->common_model->get_comparison(0,0);
        $data['active'] = $this->common_model->get_comparison(1,0);
        $data['completed'] = $this->common_model->get_comparison(2,0);
        $data['disapproved'] = $this->common_model->get_comparison(3,0);
        
        $data['yr'] = $yr = date("Y");
        $data['yr1'] = $yr1 = date("Y",strtotime("-1 year"));
        $data['yr2'] = $yr2 = date("Y",strtotime("-2 year"));
        $data['yr3'] = $yr3 = date("Y",strtotime("-3 year"));
        $data['yr4'] = $yr4 = date("Y",strtotime("-4 year"));

        $data['yrdonations'] = $this->common_model->get_year_donations($yr);
        $data['yr1donations'] = $this->common_model->get_year_donations($yr1);
        $data['yr2donations'] = $this->common_model->get_year_donations($yr2);
        $data['yr3donations'] = $this->common_model->get_year_donations($yr3);
        $data['yr4donations'] = $this->common_model->get_year_donations($yr4);
        


  	}else{
  		  $orgid = "";
  		  $data['org_count'] = $this->common_model->get_org_count();
  	    $data['emp_count'] = $this->common_model->get_emp_count($orgid,1);
  	    $data['project_count'] = $this->common_model->get_proj_count($orgid,1);
  	    $data['event_count'] = $this->common_model->get_event_count($orgid,1);
        $data['project_count1'] = $this->common_model->get_proj_count1($orgid,1);
        // print($data['project_count1']);
        $data['pendings'] = $this->common_model->get_comparison(0,0);
        $data['active'] = $this->common_model->get_comparison(1,0);
        $data['completed'] = $this->common_model->get_comparison(2,0);
        $data['disapproved'] = $this->common_model->get_comparison(3,0);

        $data['yr'] = $yr = date("Y");
        $data['yr1'] = $yr1 = date("Y",strtotime("-1 year"));
        $data['yr2'] = $yr2 = date("Y",strtotime("-2 year"));
        $data['yr3'] = $yr3 = date("Y",strtotime("-3 year"));
        $data['yr4'] = $yr4 = date("Y",strtotime("-4 year"));

        $data['yrdonations'] = $this->common_model->get_year_donations($yr);
        $data['yr1donations'] = $this->common_model->get_year_donations($yr1);
        $data['yr2donations'] = $this->common_model->get_year_donations($yr2);
        $data['yr3donations'] = $this->common_model->get_year_donations($yr3);
        $data['yr4donations'] = $this->common_model->get_year_donations($yr4);
  	}
  	
    $data['notificationdata'] = $this->get_notifications();
  	$this->load->view('dashboard_viw',$data);
  }

  

  
  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
    }
  }	

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }


}







