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
  	$orgname = $this->input->post('orgname');
  	$regno = $this->input->post('regno');
  	$orgaddress = $this->input->post('orgaddress');
  	$orgcontact = $this->input->post('orgcontact');
  	$orgtype = $this->input->post('orgtype');

  	$orgarr['org_name'] = $orgname;
  	$orgarr['reg_no'] = $regno;
  	$orgarr['org_address'] = $orgaddress;
  	$orgarr['org_contact'] = $orgcontact;
  	$orgarr['org_type'] = $orgtype;
  	$orgarr['org_stts'] = 1;
    
    $savestts=$this->common_model->insert_new_organization($orgarr);
    if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('organization/create_organization','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('organization/create_organization','refresh');
       }
  }

  function list_project(){
  	$this->is_logged();
  	$data['titlename'] = "Project List";
  	$data['orglist'] = $this->common_model->get_all_organization_list();
    $this->load->view('organization/organization_list_viw',$data);
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