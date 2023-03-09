<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

  public function create_employee(){
  	$this->is_logged();
    $this->is_privileged(12,$this->session->userdata('logged_user_id'),1);
  	$data['titlename'] = "Create Employee";
    if($this->session->userdata('org_id')==2){
      $data['orglist'] = $this->common_model->get_all_organization_list(2);
    }else{
      $data['orglist'] = $this->common_model->get_all_organization_list(1);
    }
    $this->load->view('employee/create_emp_viw',$data);
  }

  function add_employee(){
  	$orgid = $this->input->post('orgid');
  	$empname = $this->input->post('empname');
  	$empaddress = $this->input->post('empaddress');
  	$empcontact = $this->input->post('empcontact');
  	$empemail = $this->input->post('empemail');

  	$emparr['org_id'] = $orgid;
  	$emparr['emp_name'] = $empname;
  	$emparr['emp_address'] = $empaddress;
  	$emparr['emp_contact'] = $empcontact;
  	$emparr['emp_mail'] = $empemail;
  	$emparr['active_stts'] = 1;
    
    $savestts=$this->common_model->insert_new_employee($emparr);
    if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('employee/create_employee','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('employee/create_employee','refresh');
       }
  }

  function list_employee(){
    $this->is_privileged(13,$this->session->userdata('logged_user_id'),1);
  	$this->is_logged();
  	$data['titlename'] = "Employee List";
  	$data['emplist'] = $this->common_model->get_employee_list();
    $this->load->view('employee/emp_list_viw',$data);
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