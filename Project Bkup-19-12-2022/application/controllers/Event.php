<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

  public function create_event(){
  	$this->is_logged();
    $this->is_privileged(19,$this->session->userdata('user_level'),1);
  	$data['titlename'] = "Create Event";
    
    if($this->session->userdata('org_type')==2){
      $data['projlist'] = $this->common_model->get_all_projects_list(1);
    }else{
      $data['projlist'] = $this->common_model->get_all_projects_list(1);
    }

    $data['locations'] = $this->common_model->get_locations();
    $data['notificationdata'] = $this->get_notifications();
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
         if($org_cat==1){
          $eventdata = $this->common_model->get_proj_rel_org($projid);
            $to = $eventdata->org_mail;
            $sbj = "New Event ";
            $msg = "New Event ".$eventname." Created by Sub Organization.";
            $this->mail_push($to,$sbj,$msg);
          }

         redirect('event/list_event','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('event/list_event','refresh');
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

  	$data['notificationdata'] = $this->get_notifications();
    $this->load->view('event/list_event_viw',$data);
  }

  function apprv_disapprove_event(){
    $this->is_logged();
    $this->is_privileged(21,$this->session->userdata('user_level'),1);
    $data['titlename'] = "Approve/Reject Event List";
    $type = 1;
    $id = "";
    
    $data['eventlist'] = $this->common_model->get_related_event_list($id,$type,0);  
    

    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('event/apprv_disapprove_event_viw',$data);
  }

  function apprv_disapprv_events(){
    $id = $this->uri->segment(3);
    $stts = $this->uri->segment(4);
    $updevent['event_stts'] = $stts;
    $updstts = $this->common_model->update_events($id,$updevent);
    $eventdata = $this->common_model->get_event_data($id);
     if($stts==1){
            $to = $eventdata->org_mail;
            $sbj = "Event Approval";
            $msg = "Event ".$eventdata->event_title." Approved.";
            $this->mail_push($to,$sbj,$msg);
     }

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

  function event_benificiary_registration(){
    $this->is_logged();
    $this->is_privileged(35,$this->session->userdata('user_level'),1);
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

    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('event/list_event_registration_viw',$data);
  }

  function assign_beneficiary_event(){
    $id = $this->uri->segment(3);
    $data['eventid'] = $id;
    $data['notificationdata'] = $this->get_notifications();
    $evrecord = $this->common_model->get_event_detail($id);
    $data['titlename'] = $evrecord->event_title." [".$evrecord->event_id."]";


    $benlist = $this->common_model->benificiarylist($id);
    $mainarr = [];
    foreach($benlist as $bni){
      $subarr = array(
        'reg_id' => $bni->reg_id,
        'b_name' => $bni->title." ".$bni->child_name,
        'participate_count' => $this->common_model->get_benificiary_event_participation_count($bni->reg_id)
      );
      array_push($mainarr,$subarr);
    }
    $data['benificiarylist'] = $mainarr;



    $data['even_assign_benificiary'] = $this->common_model->get_event_assign_beneficiary($id);
    $this->load->view('event/assign_beneficiary_event_viw',$data);
  }

  function save_event_benificiary_register(){
    $evid = $this->input->post('evid');
    $benificiary = $this->input->post('benificiary');
    $addeventbeni['registration_id'] = $benificiary;
    $addeventbeni['event_id'] = $evid;
    $addstts = $this->common_model->add_event_benificiary_register($addeventbeni);
       if($addstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('event/assign_beneficiary_event/'.$evid,'refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('event/assign_beneficiary_event/'.$evid,'refresh');
       }
  }

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }


  function check_event_exists(){
    $evestart = $this->input->post('evestart');
    $elocation = $this->input->post('elocation');
    $stts = $this->common_model->check_event_exists($evestart,$elocation);
    echo json_encode($stts);
  }

  function mail_push($to,$sbj,$msg){
      
        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();
        $mail->isSMTP();
        $mail->Host     = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        //$mail->Username = 'hello@lcs.pathe.lk';
        //$mail->Password = 'Pathe@123';

        $mail->Username = 'test@lcs.pathe.lk';
        $mail->Password = 'T3st@123';

        $mail->Port     = 587;
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
       
        $mail->setFrom('test@lcs.pathe.lk', 'CFS');
        $mail->addReplyTo('cfsnewproject2022@gmail.com', 'CFS');
        $mail->addAddress($to);
        $mail->Subject = $sbj;
        $mail->isHTML(true);
        $mailContent = $msg;
        $mail->Body = $mailContent;
      
        if(!$mail->send()){
            echo 'Mail could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Mail has been sent';
        }
    }

}