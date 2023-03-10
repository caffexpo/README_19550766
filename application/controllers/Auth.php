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
            $user_level = $checkval->user_type_id;
            $getuser_priv = $this->common_model->get_privilages($user_level);
           
           $getuser_priv2 = [];
           
           foreach($getuser_priv as $upriv){
             //echo $upriv->page_id;
             array_push($getuser_priv2,$upriv->page_id);
           }
            
           $sess_arr = array(
             'logged_user_id' => $checkval->user_id,
             'emp_id' => $checkval->emp_id,
             'logged_user' => $checkval->emp_name,
             'user_level' => $checkval->user_type_id,
             'org_name' => $checkval->org_name,
             'org_id' => $checkval->org_id,
             'org_type' => $checkval->org_type,
             'short_name' => $checkval->short_code,
             'username' => $checkval->org_username,
             'privlages' => $getuser_priv2
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
