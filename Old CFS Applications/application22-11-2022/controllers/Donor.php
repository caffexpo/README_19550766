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
         redirect('donor','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('donor','refresh');
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

}





