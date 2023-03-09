<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

   function user_privilages(){
     $this->is_logged();
     $this->is_privileged(17,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Setup User Privilages";
     $id= "";
     $data['usertypes'] = $this->common_model->get_user_types($id);
     $data['notificationdata'] = $this->get_notifications();
    // print_r($this->session->userdata('privlages'));
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
    $data['notificationdata'] = $this->get_notifications();
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
     $data['titlename'] = "Create Login";
     $data['emplist'] = $this->common_model->get_login_not_created_emps();
     $data['usertypes'] = $this->common_model->usertypes();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('users/create_login_viw',$data);
   }

  function create_login(){
    $orgno = $this->input->post('orgno');
    $empid = $this->input->post('empid');
    $utype = $this->input->post('utype');
    $un = $this->input->post('un');
    $pwd = md5(sha1($this->input->post('pw')));
   
    $loginarr['user_type_id'] = $utype;
    $loginarr['org_id'] = $orgno;
    $loginarr['emp_id'] = $empid;
    $loginarr['org_username'] = $un;
    $loginarr['org_password'] = $pwd;
    $loginarr['active_stts'] = 1;
    
    $checkval=$this->auth_model->check_login_access($un,$pwd);
    if(sizeof($checkval)>0){
         $this->session->set_flashdata('errormsg', 'Provided Login Details Already Exist.Please Provide Another one');
         redirect('users/login_manage','refresh');
    }else{
       $addlogins = $this->common_model->add_login_details($loginarr);
       if($addlogins){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('users/login_manage','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('users/login_manage','refresh');
       }
    }

  }

  function change_login(){
    $data['titlename'] = "Change Password";
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('users/change_logins_viw',$data);
  }

  function change_password(){
    $pwd = md5(sha1($this->input->post('pw')));
    $updarr['org_password'] = $pwd;

    $rpwd = md5(sha1($this->input->post('rpwd')));
    $updarr['re_enter_pw'] = $rpwd;

    $updstts = $this->common_model->update_password($updarr);
    if($updstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('users/change_login','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('users/change_login','refresh');
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