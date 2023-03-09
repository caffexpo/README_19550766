<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiari extends CI_Controller {


	function index(){
     $this->is_logged();
     $this->is_privileged(24,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Beneficiary";
  	 $data['title'] = $this->common_model->get_title();
  	 $data['gn_div'] = $this->common_model->get_gn_divsions();
     $this->load->view('benificiary/create_beneficiary_viw',$data);
	}

  function check_username_and_password_exist(){
    $ttl = $this->input->post('ttl');
    $bname = $this->input->post('bname');
    $gndiv = $this->input->post('gndiv');
    $baddress = $this->input->post('baddress');
    $bdob = $this->input->post('bdob');
    $dcontact = $this->input->post('dcontact');

    $un = $this->input->post('uname');
    $pw = md5(sha1($this->input->post('pword')));
    $checkexistun = $this->common_model->check_login_exists($un,$pw);
    if($checkexistun==1){
      echo json_encode(1);
    }else{
      
      $beni['child_name'] = $bname;
      $beni['c_address'] = $baddress;
      $beni['c_contact'] = $dcontact;
      $beni['gn_division'] = $gndiv;
      $beni['dob'] = $bdob;
      $beni['r_username'] = $un;
      $beni['r_password'] = $pw;
      $beni['title_id'] = $ttl;
      $beni['active_stts'] = 1;
      $beni['org_id'] = $this->session->userdata('org_id');

      $this->common_model->insert_beneficiary($beni);
      echo json_encode(0);
    }
    
  }

	


    function view_benificiary(){
     $this->is_logged();
     $this->is_privileged(25,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "View Beneficiary";
     $data['benificiary_list'] = $this->common_model->get_beneficiary();
     $this->load->view('benificiary/list_beneficiary_viw',$data);
    }

    function update_status(){
      $benid = $this->uri->segment(3);
      $stts = $this->uri->segment(4);
      $updbeneficiary['active_stts']=$stts;
      $updstts = $this->common_model->update_beneficiary($updbeneficiary,$benid);
      if($updstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('beneficiari/view_benificiary','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('beneficiari/view_benificiary','refresh');
       }
    }

    function update_data(){
      $benid = $this->uri->segment(3);
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