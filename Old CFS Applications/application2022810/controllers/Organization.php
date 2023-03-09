<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends CI_Controller {

  public function create_organization(){
  	$this->is_logged();
    $this->is_privileged(10,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Create Organization";
    $this->load->view('organization/create_organization_viw',$data);
  }

  function add_organization(){
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

  function list_organizations(){
  	$this->is_logged();
    $this->is_privileged(11,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Organization List";
  	$data['orglist'] = $this->common_model->get_all_organization_list(1);
    $this->load->view('organization/organization_list_viw',$data);
  }

  function edit_organization(){
    $id = $this->uri->segment(3);
    $data['titlename'] = "Edit Organization";
    $data['orgdetails'] = $this->common_model->get_organization_detail($id);
    $this->load->view('organization/edit_organization_viw',$data);
  }

  function update_org_data(){
    $org_id = $this->input->post('org_id');
    $orgname = $this->input->post('orgname');
    $regno = $this->input->post('regno');
    $orgaddress = $this->input->post('orgaddress');
    $orgcontact = $this->input->post('orgcontact');
    $orgarr['org_name'] = $orgname;
    $orgarr['reg_no'] = $regno;
    $orgarr['org_address'] = $orgaddress;
    $orgarr['org_contact'] = $orgcontact;

    $updorg = $this->common_model->update_organization($orgarr,$org_id);
    if($updorg){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('organization/list_organizations','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('organization/list_organizations','refresh');
       }
  }

  function act_inact_organization(){
    $id = $this->uri->segment(3);
    $act_inact_stts = $this->uri->segment(4);
    $upds['org_stts'] = $act_inact_stts;
    $updorg = $this->common_model->update_organization($upds,$id);
    if($updorg){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('organization/list_organizations','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('organization/list_organizations','refresh');
       }
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