<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Rest extends REST_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model("Api_model");
    }

    public function advance_feedback_save_post(){
       

       $check_auth_client = $this->Api_model->check_auth_client();
		    if($check_auth_client == true){
		      $feedbackid = $this->post('feedback_id');
              $eventid = $this->post('event_id');
              $regid = $this->post('reg_id');

              $instarr['feedback_cat_id'] = $feedbackid;
              $instarr['event_id'] = $eventid;
              $instarr['registration_id'] = $regid;
              $instarr['e_created_on'] = date("Y-m-d H:i:s");
              $savestts = $this->api_model->save_advance_feedback($instarr);
		      if($savestts){
		        $this->set_response($response, REST_Controller::HTTP_OK);
		      }else{
		        $this->response(array('status' => 401,'message' => 'data saving error'), 401);
		      }
		    }else{
		      $this->response(array('status' => 401,'message' => 'access denaid !!!'), 401);
		    } 

    }


}