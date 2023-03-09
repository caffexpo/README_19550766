<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

  public function create_gn_division(){
  	$this->is_logged();
    $this->is_privileged(31,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Manage GN Division";
  	$data['gndivisions'] = $this->common_model->get_gn_divsions();
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('configuration/create_gndivision_viw',$data);
  }

  function add_gndivision(){
  	$gndivisions = $this->input->post('gndivisions');
  	$addrecord['gn_division'] = $gndivisions;
  	$add_stts = $this->common_model->add_data('tbl_gn_division',$addrecord);
  	if($add_stts){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('configuration/create_gn_division','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('configuration/create_gn_division','refresh');
       }
  }

  function update_gn_division(){
  	$gndivid = $this->input->post('gndivid');
  	$editvalue = $this->input->post('editvalue');
  	$updrecord['gn_division'] = $editvalue;
  	$updateval = $this->common_model->update_recrod('tbl_gn_division','gn_div_id',$updrecord,$gndivid);
  	if($updateval){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('configuration/create_gn_division','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('configuration/create_gn_division','refresh');
       }
  }

  function create_designation(){
  	$this->is_logged();
    $this->is_privileged(32,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Manage Designation";
  	$data['designations'] = $this->common_model->get_desigations();
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('configuration/create_designation_viw',$data);
  }

   function add_designation(){
  	$desg = $this->input->post('desg');
  	$addrecord['designation'] = $desg;
  	$add_stts = $this->common_model->add_data('tbl_designation',$addrecord);
  	if($add_stts){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('configuration/create_designation','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('configuration/create_designation','refresh');
       }
  }

  function update_designation(){
  	$id = $this->input->post('designationid');
  	$value = $this->input->post('designation_name');
  	$updrecord['designation'] = $value;
  	$updateval = $this->common_model->update_recrod('tbl_designation','designation_id',$updrecord,$id);
  	if($updateval){
       $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('configuration/create_designation','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Update');
         redirect('configuration/create_designation','refresh');
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


}
