<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

   function user_privilages(){
     $this->is_logged();
     $this->is_privileged(17,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Setup User Privilages";
     $id= "";
     $data['usertypes'] = $this->common_model->get_user_types($id);
    $this->load->view('users/privilage_viw',$data);
   }

   function setup_privilages(){
   	$usertypeid = $data['user_type_id'] = $this->uri->segment(3);
   	$usertype=$this->common_model->get_user_types($usertypeid);
   	$data['pages'] = $this->common_model->get_pages();
   	$data['titlename'] = "Setup ".$usertype->user_type." Privilages";

    $getusertype_privilages = $this->common_model->get_user_type_rel_privilages($usertypeid);
    $utyparr = [];
    if($getusertype_privilages){
    	foreach($getusertype_privilages as $uprivtype){
           array_push($utyparr,$uprivtype->page_id);
    	}
    }
    $data['user_privilages'] = $utyparr; 

    $this->load->view('users/setup_user_privilage_viw',$data);
   }



    function update_privilages(){
     $privid = $this->input->post('privid');
     $this->common_model->delete_old_privilages($privid);
     $chk = $this->input->post('chk');
     $length = sizeof($chk);
     for($i=0;$i<$length;$i++){
       if(!empty($chk[$i])){
         $privarr['page_id'] = $chk[$i];
         $privarr['user_type_id'] = $privid;
         //$privarr['created_on'] = date('Y-m-d h:i:s');
         //$privarr['created_by'] = $this->session->userdata('emp_id');
         $insertnewpriviage = $this->common_model->insert_new_privilages($privarr);
       }
     }
     $this->session->set_flashdata('successmsg', 'updated Succesfully');
     redirect('users/user_privilages','refresh');
  }



   function login_manage(){
     $this->is_logged();
     $this->is_privileged(18,$this->session->userdata('user_level'),1);
    /*if($this->session->userdata('org_type')==2){
      $data['emplist'] = $this->common_model->get_employee_list(2);
     }else{
      $data['emplist'] = $this->common_model->get_employee_list(1);
     }
     $data['usertypes'] = $this->common_model->get_user_types($id); */

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