<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

  public function create_event(){
  	$this->is_logged();
  	$data['titlename'] = "Create Event";
    $this->load->view('organization/create_organization_viw',$data);
  }

  function add_event(){
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

  function list_event(){
  	$this->is_logged();
  	$data['titlename'] = "Event List";
  	$data['orglist'] = $this->common_model->get_all_organization_list();
    $this->load->view('organization/organization_list_viw',$data);
  }
  
  function is_logged(){
    if($this->session->userdata('logged_user')==""){
      redirect('auth/index','refresh');
    }
  }	


}