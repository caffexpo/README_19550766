<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Rest_server extends REST_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model("Api_model");
        
    }


    public function login_post(){
      $check_auth_client = true;//$this->Api_model->check_auth_client();
        if($check_auth_client == true){
         $un = $this->post('username');
         $pw = md5(sha1($this->post('password')));
         $checklogin = $this->Api_model->check_login($un,$pw);
         if($checklogin['stts']==1){
           $response['status'] = 200;
           $response['TOKEN'] = "dfxalanfcifdfffdfs";
           $response['child_name'] = $checklogin['datas']->child_name;
           $response['reg_id'] = $checklogin['datas']->reg_id;

           $this->set_response($response, REST_Controller::HTTP_OK);
         }else{
          $this->response(array('status' => 401,'message' => 'Invalid Login.please Try Again !!!'), 401);
         } 

        }else{
          $this->response(array('status' => 401,'message' => 'access denaid !!!'), 401);
        } 
    }

   /* public function check_event_id_post(){
      $check_auth_client = true;//$this->Api_model->check_auth_client();
        if($check_auth_client == true){
         $eveid = $this->post('event_id');
         
         $checkevestts = $this->Api_model->check_event_exist($eveid);
         if($checkevestts==1){
           $response['status'] = 200;
           
           $this->set_response($response, REST_Controller::HTTP_OK);
         }else{
          $this->response(array('status' => 401,'message' => 'Invalid Login.please Try Again !!!'), 401);
         } 

        }else{
          $this->response(array('status' => 401,'message' => 'access denaid !!!'), 401);
        } 
    } */

    public function advance_feedback_save_post(){
       $check_auth_client = $this->Api_model->check_auth_client();
		    if($check_auth_client == true){
		          $feedbackid = $this->post('feedback_id');
              $eventid = $this->post('event_id');
              $regid = $this->post('reg_id');
              //check event no is valid..
              $checkevntexist = $this->Api_model->check_event_exists($eventid);
              if($checkevntexist==1){
                $checkexist = $this->Api_model->check_feedback_exists($eventid,$regid);
                if($checkexist==0){
                  $instarr['feedback_cat_id'] = $feedbackid;
                  $instarr['event_id'] = $eventid;
                  $instarr['registration_id'] = $regid;
                  $instarr['e_created_on'] = date("Y-m-d H:i:s");
                  $recstts = $this->Api_model->save_advance_feedback($instarr);
                  if($recstts){
                    $response = array(
                       'status' => 200,
                       'message' => 'Feedback Saved Succesfully',
                       'code' => 1
                    ); 
                    $this->set_response($response, REST_Controller::HTTP_OK);
                  }else{
                    $this->response(array('status' => 200,'message' => 'data saving error','code' => 2), 200);
                  }
                }else{
                  $this->response(array('status' => 402,'message' => 'You Have Already gave Feedback for this Event !!!','code' => 3), 200);
                }
              }else{
                $this->response(array('status' => 200,'message' => 'Invalid Event ID.Please RE-Enter correct one','code' => 5), 200);
              }
              
              
		      
		    }else{
		      $this->response(array('status' => 200,'message' => 'access denaid !!!','code' => 4), 200);
		    } 

    }


    public function open_feedback_save_post(){
       $check_auth_client = $this->Api_model->check_auth_client();
        if($check_auth_client == true){
              
              $feedback = $this->post('feedback');
              $regid = $this->post('reg_id');
              
                $instarr['registration_id'] = $regid;
                $instarr['feedback'] = $feedback;
                $instarr['ofb_created_on'] = date("Y-m-d H:i:s");
                $recstts = $this->Api_model->save_general_feedback($instarr);
                if($recstts){
                  $response = array(
                     'status' => 200,
                     'message' => 'Feedback Saved Succesfully'
                  ); 
                  $this->set_response($response, REST_Controller::HTTP_OK);
                }else{
                  $this->response(array('status' => 401,'message' => 'data saving error'), 401);
                }
              
              
          
        }else{
          $this->response(array('status' => 401,'message' => 'access denaid !!!'), 401);
        } 

    }


}