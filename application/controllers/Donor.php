<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donor extends CI_Controller {


	function index(){
     $this->is_logged();
     $this->is_privileged(22,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Donor";
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('donor/create_donor_viw',$data);
	}

  function add_donor(){
     $dnrname = $this->input->post('dnrname');
     $demail = $this->input->post('demail');
     $daddress = $this->input->post('daddress');
     $dcontact = $this->input->post('dcontact');

     $dnrarr = array(
       'donor' => $dnrname,
       'd_address' => $daddress,
       'd_contact' => $dcontact,
       'd_mail' => $demail,
       'donor_stts' => 1
     );

     $add_donor = $this->common_model->add_new_donor($dnrarr);
     if($add_donor){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('donor/view_donor','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('donor/view_donor','refresh');
       }
  }

  function view_donor(){
      $this->is_logged();
      $this->is_privileged(23,$this->session->userdata('user_level'),1);
      $data['titlename'] = "View Donor";
      $getdonors = $this->common_model->list_donors();
      
      $mainarr = [];
      
        foreach($getdonors as $gd){
          $dnrid = $gd->donor_id;
          $dnrarr = array(
            'dnrid' => $dnrid,
            'donor' => $gd->donor,
            'daddress' => $gd->d_address,
            'dcontact' => $gd->d_contact,
            'dmail' => $gd->d_mail,
            'dstatus' => $gd->donor_stts,
            'dnrstages' => $this->common_model->get_donor_stages($dnrid)
          );

          array_push($mainarr,$dnrarr);
        }

        $data['donorlist'] = $mainarr;
     $data['notificationdata'] = $this->get_notifications();
      $this->load->view('donor/donor_list_viw',$data);
  }

  function act_inact_donor(){
    $donorid = $this->uri->segment(3);
    $status = $this->uri->segment(4);
    $upddnr['donor_stts'] = $status;
    $upd_donor = $this->common_model->update_donor($upddnr,$donorid);
    if($upd_donor){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('donor/view_donor','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('donor/view_donor','refresh');
       }
  }

  function edit_donor(){
    $donor_id = $this->uri->segment(3);
    $data['titlename'] = "Edit Donor";
    $data['donordetails'] = $this->common_model->get_curent_donor_details($donor_id);
    $data['notificationdata'] = $this->get_notifications();
    $this->load->view('donor/edit_donor_viw',$data);
  }

  function update_donor(){
    $donorid = $this->input->post('donorid');
    $dnrarr = array(
       'donor' => $this->input->post('ednrname'),
       'd_address' => $this->input->post('ednraddress'),
       'd_contact' => $this->input->post('ednrcontact'),
       'd_mail' => $this->input->post('ednremail')
     );
    $upd_donor = $this->common_model->update_donor($dnrarr,$donorid);
    if($upd_donor){
         $this->session->set_flashdata('successmsg', 'Succesfully Updated');
         redirect('donor/view_donor','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Updating');
         redirect('donor/view_donor','refresh');
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


  function check_grnsave(){


     $this->load->view('donor/grnview');
  }

  function dddd(){
    $id = $this->input->post('id');

     for($i=1;$i<=$id;$i++){
      $itm = $this->input->post('item_name'.$i);
      $qty = $this->input->post('item_count'.$i);
      if($itm!="" || $qty!=""){
        echo $itm." ".$qty."<br>";
      }
     }
  }

  function get_notifications(){
    $data['pending_benificiry'] = $this->common_model->count_pending_benificiary();
    $data['pending_projects'] = $this->common_model->count_pending_projects();
    $data['pending_events'] = $this->common_model->count_pending_events();
    return $data;
  }

  function donor_awards(){
    $this->is_logged();
     $this->is_privileged(37,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Donor Awards";
     $data['notificationdata'] = $this->get_notifications();
     $data['donor_awards'] = $this->common_model->get_financial_yearwise_awards(date("Y"));
     $this->load->view('donor/donor_awards_viw',$data);
  }

  function send_award_mail(){
    $donor_awards = $this->common_model->get_financial_yearwise_awards(date("Y"));
    if($donor_awards){
      foreach($donor_awards as $da){
          $to = $da->d_mail;
          $sbj= "Donor Awards";
          $msg="Dear ".$da->donor.", You have Been awarded as ".$da->donor_stage." (".$da->year_donation.") .Thank you for your donation";

          $this->mail_push($to,$sbj,$msg);
      }
      redirect('donor/donor_awards');
    }
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

    function view_donor_donations(){
      $id = $this->uri->segment(3);
      $data['dnrstages']=$this->common_model->get_donor_stages($id);
      $data['titlename'] = "View Donor Donations";
    
      $data['notificationdata'] = $this->get_notifications();
      $this->load->view('donor/view_donor_donations_viw',$data);
    }

}





