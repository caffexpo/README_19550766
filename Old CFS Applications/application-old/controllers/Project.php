<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

  public function create_project(){
  	$this->is_logged();
  	$data['titlename'] = "Create Project";
    $this->load->view('organization/create_organization_viw',$data);
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


}