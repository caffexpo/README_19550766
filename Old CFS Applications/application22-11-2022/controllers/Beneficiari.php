<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiari extends CI_Controller {


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
    
    $ttl = $this->input->post('ttl');
    $bname = $this->input->post('bname');
    $gndiv = $this->input->post('gndiv');
    $baddress = $this->input->post('baddress');
    $bdob = $this->input->post('bdob');
    $dcontact = $this->input->post('dcontact');
    $nic =  $this->input->post('nic');

      $beni['child_name'] = $bname;
      $beni['c_address'] = $baddress;
      $beni['c_contact'] = $dcontact;
      $beni['gn_division'] = $gndiv;
      $beni['dob'] = $bdob;
      $beni['title_id'] = $ttl;
      $beni['active_stts'] = 1;
      $beni['bnic'] = $nic;
      if($this->session->userdata('org_type')==2){
       $beni['approve_stts'] = 0;
      }else{
       $beni['approve_stts'] = 1;
      }
      $beni['org_id'] = $this->session->userdata('org_id');
      $beni['benificiary_code'] = $this->session->userdata('short_name');

      $inserid = $this->common_model->insert_beneficiary($beni);
      if($inserid){
       /* $this->mail_push('','','');*/
        $username = "U".$this->session->userdata('org_id').$inserid;
        redirect('beneficiari/create_logins/'.$username."/".$inserid);
      }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('beneficiari/view_benificiary','refresh');
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
         redirect('beneficiari','refresh');
       }else{
         $this->session->set_flashdata('errormsg', 'Error Saving');
         redirect('beneficiari','refresh');
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
    }

    function appr_disapprove_benificiary(){
     $this->is_logged();
     $this->is_privileged(34,$this->session->userdata('user_level'),1);
     $data['titlename'] = "Approve/Disapprove Beneficiary";
    
     $data['benificiary_list'] = $this->common_model->get_pending_benificiries();
     $data['notificationdata'] = $this->get_notifications();
     $this->load->view('benificiary/approve_beneficiary_viw',$data);
  }

  function update_approve_status(){
     $benid = $this->uri->segment(3);
      $stts = $this->uri->segment(4);
      $updbeneficiary['approve_stts']=$stts;
      $updstts = $this->common_model->update_beneficiary($updbeneficiary,$benid);
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
    $to_email = "rajadinithi@gmail.com";
     
    $subject = "Simple Email Test via PHP";
    $body = "Hi,nn This is test email send by PHP Script";
    $headers = "From: sender\'s email";

    if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
    } else {
     echo "Email sending failed...";
    }
  }

  /*function mail_push($to,$sbj,$msg){
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'agrigainssl@gmail.com';
        $mail->Password = 'agrigain123';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('agrigainssl@gmail.com', 'CodexWorld');
        $mail->addReplyTo('agrigainssl@gmail.com', 'CodexWorld');
        
        // Add a recipient
        $mail->addAddress('mptpman1988@gmail.com');
        
        // Add cc or bcc 
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    } */


}