<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complains extends CI_Controller {


	function index(){
     $this->is_logged();
     $this->is_privileged(28,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Complain";
  	 $data['complaincats'] = $this->common_model->get_complain_cats();
  	 $data['gn_div'] = $this->common_model->get_gn_divsions();
  	 $data['benificiary_list'] = $this->common_model->get_beneficiary();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('complains/create_complains_viw',$data);
	}

    function create_complain_category(){
     $this->is_logged();
     $this->is_privileged(29,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Complain category";
  	 $data['complaincats'] = $this->common_model->get_complain_cats();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('complains/create_complains_cat_viw',$data);
    }

    function save_complain_category(){
    	$comp_cat = $this->input->post('comp_cat');
    	$compcatarr['complain_category'] = $comp_cat;
    	$savestts = $this->common_model->save_complain_cats($compcatarr);
    	if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('Complains/create_complain_category','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('Complains/create_complain_category','refresh');
       }
    }

    function save_complain(){
        $compcatarr['org_id'] = $this->session->userdata('org_id');
        $compcatarr['compln_cat_id'] = $this->input->post('compcatid');
        $compcatarr['child_name'] = $this->input->post('beni');
        $compcatarr['ds_division'] = $this->input->post('gndiv');
        $compcatarr['complain_date'] = date("Y-m-d");
        $compcatarr['complain_stts'] = 1;
        $compcatarr['complain'] = $this->input->post('complains');
        $savestts = $this->common_model->save_complains($compcatarr);
    	if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('Complains','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('Complains','refresh');
       }

    }

    function list_complains(){
    	
     $this->is_logged();
     $this->is_privileged(30,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Complain category";
  	 $data['complaincats'] = $this->common_model->get_complain_cats();
  	 if(isset($_POST['srch'])){
  	 	$stts = $this->input->post('stts');
  	 	$compcatid = $this->input->post('compcatid');
        $data['complains'] = $this->common_model->get_complains_by_cat($stts,$compcatid);
  	 }else{
  	 	$data['complains'] = [];
  	 }

     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('complains/complains_list_viw',$data);
    }

    function complains_followup(){
      $this->is_logged();
      $this->is_privileged(30,$this->session->userdata('user_level'),1);
      $id = $this->uri->segment(3);
      $data['fuid'] = $id;
      $data['getcomplain'] = $this->common_model->complain_data($id);
      $data['followups'] = $this->common_model->complain_followups_data($id);
  	  $data['titlename'] = "Complain Follow ups";
      $data['notificationdata'] = $this->get_notifications();
  	  $this->load->view('complains/complains_followup_viw',$data);
    }

    function add_followup(){
    	date_default_timezone_set('Asia/Kolkata');
        
    	if(isset($_POST['save_fu'])){
    		$id = $this->input->post('compid');
	    	$addfu['complain_id'] = $id;
	    	$addfu['followup'] = $this->input->post('fucommet');
	    	$addfu['folllowup_date'] = date("Y-m-d H:i:s");
	    	$addfu['followup_by'] = $this->session->userdata('logged_user_id');
	    	$savefollowupstts = $this->common_model->add_followups($addfu);
    	}

    	
    	if(isset($_POST['finish_fu'])){
    		$id = $this->input->post('compid');
	    	$addfu['complain_id'] = $id;
	    	$addfu['followup'] = $this->input->post('fucommet');
	    	$addfu['folllowup_date'] = date("Y-m-d H:i:s");
	    	$addfu['followup_by'] = $this->session->userdata('logged_user_id');
            
            $upd['complain_close_cmmnt'] = $this->input->post('fucommet');
            $upd['complain_close_date'] = date("Y-m-d H:i:s");
            $upd['complain_stts'] = 2;
            $this->common_model->update_complains($upd,$id);
	    	$savefollowupstts = $this->common_model->add_followups($addfu);
    	}
    	
    	if($savefollowupstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('Complains/complains_followup/'.$id,'refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('Complains/complains_followup/'.$id,'refresh');
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
