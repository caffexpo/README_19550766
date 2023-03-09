<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {


	function advance_feedback(){
     $this->is_logged();
     $this->is_privileged(26,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Advance Feedback";
  	 if($this->session->userdata('org_type')==2){
      $data['projlist'] = $this->common_model->get_all_projects_list(2);
    }else{
      $data['projlist'] = $this->common_model->get_all_projects_list(1);
    }

    $type = 1;
    if(isset($_POST['searchevent'])){
      $id = $this->input->post('projid');
      $eventlist = $this->common_model->get_related_event_list($id,$type,1);
      $mainarr = [];
      foreach($eventlist as $elst){
        $subarr = array(
          'project_name' => $elst->project_name,
          'event_title' => $elst->event_title,
          'location' => $elst->location,
          'totalfeedbacks' => $this->common_model->get_ratings_count_total($elst->event_id,0),
          'verygood' => $this->common_model->get_ratings_count($elst->event_id,1),
          'good' => $this->common_model->get_ratings_count($elst->event_id,2),
          'poor' => $this->common_model->get_ratings_count($elst->event_id,3),
          'toobad' => $this->common_model->get_ratings_count($elst->event_id,4)
        );

        array_push($mainarr,$subarr);
      }
      $data['eventlist'] = $mainarr;

    }else{
      $data['eventlist'] = [];
    }
   
     $this->load->view('Feedback/advance_feedback_viw',$data);
	}

	function general_feedback(){
     $this->is_logged();
     $this->is_privileged(27,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "General Feedback";
  	 $data['openfeedback'] = $this->common_model->open_feedbacks();
     $this->load->view('Feedback/general_feedback_viw',$data);
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