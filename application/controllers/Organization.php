<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends CI_Controller {

  function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

  public function create_organization(){
  	$this->is_logged();
    $this->is_privileged(10,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Create Organization";
    $data['notificationdata'] = $this->get_notifications();
     $data['basestation']  = $this->common_model->get_base_station();
    $this->load->view('organization/create_organization_viw',$data);
  }

  function add_organization(){
    $abcd = $this->input->post('orgtype');
    $this->form_validation->set_rules('shortcode', 'Short code', 'required|is_unique[tbl_organization.short_code]');
    $this->form_validation->set_rules('orgcontact', 'Contact No', 'required|numeric');
    $this->form_validation->set_rules('orgemail', 'Email', 'required|is_unique[tbl_organization.org_mail]');
    $this->form_validation->set_rules('orgtype', 'Select ORG type', 'required');
    $this->form_validation->set_rules('base_station', 'Select District', 'required');


    if ($this->form_validation->run() == FALSE){
        $data['titlename'] = "Create Organization";
        $data['notificationdata'] = $this->get_notifications();
        $this->load->view('organization/create_organization_viw',$data);
    }else{
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
        $orgarr['short_code'] = $this->input->post('shortcode');
        $orgarr['org_mail'] = $this->input->post('orgemail');
        $orgarr['org_district'] = $this->input->post('base_station');
        
           $savestts=$this->common_model->insert_new_organization($orgarr);
           if($savestts){
             $this->session->set_flashdata('successmsg', 'Succesfully Saved');
             redirect('organization/list_organizations','refresh');
           }else{
             $this->session->set_flashdata('errormsg', 'Error Saving');
             redirect('organization/list_organizations','refresh');
           }
    }

  	
  }

  function select_validate($abcd){
    // 'none' is the first option that is default "-------Choose City-------"
    if($abcd=="none"){
    $this->form_validation->set_message('select_validate', 'Please Select Your City.');
    return false;
    } else{
    // User picked something.
    return true;
    }
  }

  function list_organizations(){
  	$this->is_logged();
    $this->is_privileged(11,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Organization List";
  	$data['orglist'] = $this->common_model->get_all_organization_list(1);
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('organization/organization_list_viw',$data);
  }

  function edit_organization(){
    $id = $this->uri->segment(3);
    $data['titlename'] = "Edit Organization";
    $data['orgdetails'] = $this->common_model->get_organization_detail($id);
    $data['notificationdata'] = $this->get_notifications();
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
      $orgarr['org_mail'] = $this->input->post('orgemail');

      $updorg = $this->common_model->update_organization($orgarr,$org_id);
      if($updorg){
         $this->session->set_flashdata('successmsg', 'Succesfully Updated');
           redirect('organization/list_organizations','refresh');
         }else{
           $this->session->set_flashdata('errormsg', 'Error Update');
           redirect('organization/list_organizations','refresh');
         }
    

    
  }

 /* function update_org_data(){

    $this->form_validation->set_rules('shortcode', 'Short code', 'required|is_unique[tbl_organization.short_code]');
    $this->form_validation->set_rules('orgcontact', 'Contact No', 'required|numeric');
    $this->form_validation->set_rules('orgemail', 'Email', 'required|is_unique[tbl_organization.org_mail]');

    if ($this->form_validation->run() == FALSE){
      $org_id = $this->input->post('org_id');
      $data['titlename'] = "Edit Organization";
      $data['orgdetails'] = $this->common_model->get_organization_detail($org_id);
      $data['notificationdata'] = $this->get_notifications();
    $this->load->view('organization/edit_organization_viw',$data);
    }else{
      $org_id = $this->input->post('org_id');
      $orgname = $this->input->post('orgname');
      $regno = $this->input->post('regno');
      $orgaddress = $this->input->post('orgaddress');
      $orgcontact = $this->input->post('orgcontact');
      $orgarr['org_name'] = $orgname;
      $orgarr['reg_no'] = $regno;
      $orgarr['org_address'] = $orgaddress;
      $orgarr['org_contact'] = $orgcontact;
      $orgarr['org_mail'] = $this->input->post('orgemail');

      $updorg = $this->common_model->update_organization($orgarr,$org_id);
      if($updorg){
         $this->session->set_flashdata('successmsg', 'Succesfully Updated');
           redirect('organization/list_organizations','refresh');
         }else{
           $this->session->set_flashdata('errormsg', 'Error Update');
           redirect('organization/list_organizations','refresh');
         }
    }

    
  } */

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

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }

  function check_short_code_exist(){
    $shortcode = $this->input->post('shortcode');
    $stts = $this->common_model->check_exist($shortcode);
    echo json_encode($stts);
  }


}