<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function create_project(){
  	$this->is_logged();
    $this->is_privileged(14,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Create Project";
    if($this->session->userdata('org_type')==2){
      $data['orglist'] = $this->common_model->get_all_organization_list(2);
    }else{
      $data['orglist'] = $this->common_model->get_all_organization_list(1);
    }
    $data['donor'] = $this->common_model->get_donors();
    $this->load->view('project/create_project_viw',$data);
  }

  function add_project(){
    $org_cat = $this->session->userdata('org_type');

  	$orgid = $this->input->post('orgid');
  	$projname = $this->input->post('projname');
  	$projstart = $this->input->post('projstart');
  	$projstartfrom = $this->input->post('projstartfrom');
  	$projto = $this->input->post('projto');
    $budget = $this->input->post('budget');
    $no_benifciaries = $this->input->post('no_benifciaries');
    $proj_desc = $this->input->post('proj_desc');
    $donorid = $this->input->post('donorid');

    if($org_cat==1){
      $projarr['proj_stts'] = 1;
    }else{
      $projarr['proj_stts'] = 0;
    }

  	$projarr['project_name'] = $projname;
  	$projarr['org_id'] = $orgid;
  	$projarr['proj_desc'] = $proj_desc;
  	$projarr['project_start_date'] = $projstart;
  	$projarr['prj_from'] = $projstartfrom;
  	$projarr['prj_to'] = $projto;
    $projarr['proj_budget'] = $budget;
    $projarr['num_of_benefitiories'] = $no_benifciaries;
    $projarr['donor_id'] = $donorid;
    $projarr['balance_budget'] = $budget;
    
    $savestts=$this->common_model->insert_new_project($projarr);
    if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('project/create_project','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('project/create_project','refresh');
       }
  }

  function list_project_approve_disaprove(){
    $this->is_logged();
    $this->is_privileged(15,$this->session->userdata('user_level'),1);
    $data['titlename'] = "Project List";
    $data['prjlistforapproval'] = $this->common_model->get_all_project_list_for_approval(1);
    $this->load->view('project/project_approve_disapprove_list_viw',$data);
  }

  function list_project(){
  	$this->is_logged();
    $this->is_privileged(16,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Project List";
  	$data['prjlistforapproval'] = $this->common_model->get_all_project_list_for_approval(0);
    $this->load->view('project/project_list_viw',$data);
  }
  
  function approve_disapprove_project(){
    $projid = $this->uri->segment(3);
    $apprdisappstts = $this->uri->segment(4);
    $upd_project['proj_stts'] = $apprdisappstts;
    $updstts = $this->common_model->update_projects($upd_project,$projid);
    if($updstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('project/list_project_approve_disaprove','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('project/list_project_approve_disaprove','refresh');
       }
  }

  function event_list(){

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