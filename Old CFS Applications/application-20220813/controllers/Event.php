<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

  public function create_event(){
  	$this->is_logged();
    $this->is_privileged(19,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Create Event";
    
    if($this->session->userdata('org_type')==2){
      $data['projlist'] = $this->common_model->get_all_projects_list(2);
    }else{
      $data['projlist'] = $this->common_model->get_all_projects_list(1);
    }

    $data['locations'] = $this->common_model->get_locations();

    $this->load->view('event/create_event_viw',$data);
  }

  function add_event(){
    $org_cat = $this->session->userdata('org_type');

  	$projid = $this->input->post('projid');
  	$eventname = $this->input->post('eventname');
  	$elocation = $this->input->post('elocation');
  	$yr = $this->input->post('yr');
  	$mnt = $this->input->post('mnt');
    $evbudget = $this->input->post('evbudget');
    $no_benifciaries = $this->input->post('no_benifciaries');
    $evestart = $this->input->post('evestart');

    $curbalance = $this->input->post('curbalance');

    if($org_cat==1){
      $evearr['event_stts'] = 1;
    }else{
      $evearr['event_stts'] = 0;
    }

  	$evearr['proj_id'] = $projid;
  	$evearr['event_title'] = $eventname;
  	$evearr['location'] = $elocation;
  	$evearr['benifitiaries'] = $no_benifciaries;
  	$evearr['year'] = $yr;
  	$evearr['month'] = $mnt;
    $evearr['event_budget'] = $evbudget;
    $evearr['event_date'] = $evestart;

    $prjarr['balance_budget'] = $curbalance-$evbudget;
    $this->common_model->update_projects($prjarr,$projid);


    
    $savestts=$this->common_model->insert_new_event($evearr);
    if($savestts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('event/create_event','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('event/create_event','refresh');
       }
  }

  function list_event(){
  	$this->is_logged();
    $this->is_privileged(20,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Event List";

    if($this->session->userdata('org_type')==2){
      $data['projlist'] = $this->common_model->get_all_projects_list(2);
    }else{
      $data['projlist'] = $this->common_model->get_all_projects_list(1);
    }
    
    $type = 1;
    if(isset($_POST['searchevent'])){
      $id = $this->input->post('projid');
      $data['eventlist'] = $this->common_model->get_related_event_list($id,$type,1);
    }else if($this->uri->segment(3)!==""){
      $id = $this->uri->segment(3);
      $data['eventlist'] = $this->common_model->get_related_event_list($id,$type,1);
    }else{
      $data['eventlist'] = [];
    }

  	
    $this->load->view('event/list_event_viw',$data);
  }

  function apprv_disapprove_event(){
    $this->is_logged();
    $this->is_privileged(21,$this->session->userdata('user_level'),1);
    $data['titlename'] = "Approve/Disapprove Event List";
    $type = 1;
    $id = "";
    if($this->session->userdata('org_type')==2){
    $data['eventlist'] = $this->common_model->get_related_event_list($id,$type,0);
    }else{
    $data['eventlist'] = $this->common_model->get_related_event_list($id,$type,0);  
    }
    $this->load->view('event/apprv_disapprove_event_viw',$data);
  }

  function apprv_disapprv_events(){
    $id = $this->uri->segment(3);
    $stts = $this->uri->segment(4);
    $updevent['event_stts'] = $stts;
    $updstts = $this->common_model->update_events($id,$updevent);
    if($updstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('event/apprv_disapprove_event','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('event/apprv_disapprove_event','refresh');
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



}