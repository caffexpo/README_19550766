<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiari extends CI_Controller {


 function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

	function index(){
     $this->is_logged();
     $this->is_privileged(24,$this->session->userdata('user_level'),1);
  	 $data['titlename'] = "Create Beneficiary";
  	 $data['title'] = $this->common_model->get_title();
  	 $data['gn_div'] = $this->common_model->get_gn_divsions();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('benificiary/create_beneficiary_viw',$data);
	}


  function add_beneficiari(){


    $this->form_validation->set_rules('bmail', 'Email', 'required|is_unique[tbl_beneficiaries.email_address]');
    $this->form_validation->set_rules('bnic', 'NIC', 'required|is_unique[tbl_beneficiaries.bnic]');

     if ($this->form_validation->run() == FALSE){
         $data['titlename'] = "Create Beneficiary";
         $data['title'] = $this->common_model->get_title();
         $data['gn_div'] = $this->common_model->get_gn_divsions();
         $data['notificationdata'] = $this->get_notifications();
         $this->load->view('benificiary/create_beneficiary_viw',$data);
     }else{
        $ttl = $this->input->post('ttl');
        $bname = $this->input->post('bname');
        $gndiv = $this->input->post('gndiv');
        $baddress = $this->input->post('baddress');
        $bdob = $this->input->post('bdob');
        $dcontact = $this->input->post('dcontact');

          $beni['child_name'] = $bname;
          $beni['c_address'] = $baddress;
          $beni['c_contact'] = $dcontact;
          $beni['gn_division'] = $gndiv;
          $beni['email_address'] = $this->input->post('bmail');
          $beni['dob'] = $bdob;
          $beni['title_id'] = $ttl;
          $beni['bnic'] = $this->input->post('bnic');
          $beni['active_stts'] = 1;
          if($this->session->userdata('org_type')==2){
           $beni['approve_stts'] = 0;
          }else{
           $beni['approve_stts'] = 1;
          }
          $beni['org_id'] = $this->session->userdata('org_id');
          $beni['benificiary_code'] = $this->session->userdata('short_name');

          $inserid = $this->common_model->insert_beneficiary($beni);
          if($inserid){
            //$this->mail_push('','','');
            $username = "U".date("Y").$inserid;
            redirect('beneficiari/create_logins/'.$username."/".$inserid);
          }else{
             $this->session->set_flashdata('errormsg', 'Error Saving');
             redirect('beneficiari/view_benificiary','refresh');
          }
     }

    
    
  }

  function create_logins(){
     $data['id'] = $this->uri->segment(4);
     $data['un'] = $this->uri->segment(3);
     $this->is_logged();
     $this->is_privileged(24,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Create Beneficiary";
     $data['title'] = $this->common_model->get_title();
     $data['gn_div'] = $this->common_model->get_gn_divsions();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('benificiary/create_login_viw',$data);
  }

  function add_beneficiari_login(){
    $bid = $this->input->post('bid');
    $uname = $this->input->post('uname');
    $pword = $this->input->post('pword');
    $beni['r_username'] = $uname;
    $beni['r_password'] = md5(sha1($pword));
    $updlogin = $this->common_model->update_logins($bid,$beni);
    if($updlogin){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('beneficiari/view_benificiary','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('beneficiari/view_benificiary','refresh');
       }
  }

  function check_username_and_password_exist(){
    

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
     $data['notificationdata'] = $this->get_notifications();
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
      $page = $this->uri->segment(4);
      $data['regid'] = $benid;
      $data['pageid'] = $page;
      $data['titlename'] = "Edit Beneficiary";
      $data['title'] = $this->common_model->get_title();
      $data['gn_div'] = $this->common_model->get_gn_divsions();
      $data['beneficiary_data'] = $this->common_model->get_beneficiary_details($benid);
      $data['orglist'] = $this->common_model->get_all_organization_list(1);
      $data['notificationdata'] = $this->get_notifications();
      $this->load->view('benificiary/edit_beneficiary_viw',$data);

    }

    function edit_beneficiari(){
      $regid = $this->input->post('regid');
      $page = $this->input->post('page');
      $ttl = $this->input->post('ttl');
      $bname = $this->input->post('bname');
      $gndiv = $this->input->post('gndiv');
      $baddress = $this->input->post('baddress');
      $bdob = $this->input->post('bdob');
      $dcontact = $this->input->post('dcontact');

        $beni['child_name'] = $bname;
        $beni['c_address'] = $baddress;
        $beni['c_contact'] = $dcontact;
        $beni['gn_division'] = $gndiv;
        $beni['email_address'] = $this->input->post('bmail');
        $beni['dob'] = $bdob;
        $beni['title_id'] = $ttl;
        $beni['bnic'] = $this->input->post('bnic');
        $beni['org_id'] = $this->input->post('orgid');
        $beni['benificiary_code'] = $this->input->post('shortcode');
        $updstts = $this->common_model->update_benificiaries($beni,$regid);
        if($updstts){
           if($page==1){
            $this->session->set_flashdata('successmsg', 'Succesfully Saved');
            redirect('beneficiari/view_benificiary','refresh');
           }else{
            $this->session->set_flashdata('successmsg', 'Succesfully Saved');
            redirect('beneficiari/appr_disapprove_benificiary','refresh');
           }
         }else{
          if($page==1){
            $this->session->set_flashdata('errormsg', 'Error Saving');
            redirect('beneficiari/view_benificiary','refresh');
          }else{
            $this->session->set_flashdata('errormsg', 'Error Saving');
            redirect('beneficiari/appr_disapprove_benificiary','refresh');
          }
         
        }
    }

    function appr_disapprove_benificiary(){
     $this->is_logged();
     $this->is_privileged(34,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Approve/Reject Beneficiary";
    
     $data['benificiary_list'] = $this->common_model->get_pending_benificiries();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('benificiary/approve_beneficiary_viw',$data);
  }

  function update_approve_status(){
     $benid = $this->uri->segment(3);
      $stts = $this->uri->segment(4);
      $updbeneficiary['approve_stts']=$stts;
      $updstts = $this->common_model->update_beneficiary($updbeneficiary,$benid);
      $beneficiary_data = $this->common_model->get_beneficiary_details($benid);
      if($stts==1){
        $to = $beneficiary_data->email_address;
        $sbj = "Greetings from CFS";
        $msg = "Congratulations ".$beneficiary_data->child_name.". Your Account is Verified by CFS Team.Now you can login to app.your user name is ".$beneficiary_data->r_username." and Password is the Given password when register";
        $this->mail_push($to,$sbj,$msg);
      }
      
      if($updstts){
         $this->session->set_flashdata('successmsg', 'Succesfully Saved');
         redirect('beneficiari/appr_disapprove_benificiary','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('beneficiari/appr_disapprove_benificiary','refresh');
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