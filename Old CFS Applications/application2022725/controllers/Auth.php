<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index(){
		$this->load->view('login_viw');
	}

    function check_login(){
    	$username = $this->input->post('username');
    	$password = md5(sha1($this->input->post('password')));       
    	$checkval=$this->auth_model->check_login_access($username,$password);
    	if(sizeof($checkval)>0){
           // redirect to dashboard
            
           $sess_arr = array(
             'logged_user_id' => $checkval->user_id,
             'emp_id' => $checkval->emp_id,
             'logged_user' => $checkval->emp_name,
             'user_level' => $checkval->user_type_id,
             'org_name' => $checkval->org_name,
             'org_id' => $checkval->org_id,
             'org_type' => $checkval->org_type
           ); 

           $this->session->set_userdata($sess_arr);
           redirect('dashboard'); 
        }else{
           // show message in login view  
           $this->session->set_flashdata('errormsg', 'Invalid Login');
           redirect('auth/index','refresh');
        }
    }



    function logout(){
        session_destroy();
        redirect('auth/index','refresh');
    }

	
}
