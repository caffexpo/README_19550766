<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

  function project_status_rpt(){
    $this->is_logged();
    $this->is_privileged(16,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Project List";
  	if(isset($_POST['search'])){
  		$stts = $this->input->post('stts');
  		$data['prjlistforapproval'] = $this->common_model->get_all_project_by_stts($stts);
  	}else{
  		$data['prjlistforapproval'] = [];
  	}
  	$data['notificationdata'] = $this->get_notifications();
    $this->load->view('reports/project_list_viw',$data);
  }


  function donations_inhand(){
  	$this->is_logged();
    $this->is_privileged(16,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Donations in hand";
  	if(isset($_POST['search'])){
  		$stts = $this->input->post('stts');
        //echo $stts;
  		$data['prjlistforapproval'] = $this->common_model->get_all_project_by_balance_donations($stts);
  	}else{
  		$data['prjlistforapproval'] = [];
  	}
  	$data['notificationdata'] = $this->get_notifications();
    $this->load->view('reports/donation_in_hand_rpt_viw',$data);
  }



  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
    }
  }	

  function is_privileged($pageid,$user,$cat){
     $retval = $this->common_model->check_privilage($pageid,$user,$cat);
     if($retval==0){
      redirect('Unauth','refresh');
    }
  }

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }

  function beneficiary_event_rpt(){
    $data['titlename'] = "Benificiary outreach";
    $data['notificationdata'] = $this->get_notifications();
    

    if(isset($_POST['search'])){
      $fromd = $this->input->post('fromd');
      $tod = $this->input->post('tod');
      $data['rpt_title'] = $fromd." to ".$tod." Benificiary outreach";
      $data['benificiary_outreach'] = $this->common_model->get_date_related_event_details($fromd,$tod);
    }else{
      $data['rpt_title'] = "";
      $data['benificiary_outreach'] = [];
    }

    $this->load->view('reports/beneficiary_outreach_rpt_viw',$data);
  }


}  