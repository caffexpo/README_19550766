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


}  