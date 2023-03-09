<?php 
ob_start();
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    var $client_service = "frontend-client";
    var $auth_key       = "HzuRclxrYxQ5aDQs7VMJMbIpyodU23wM";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
         
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return true;
        }
    }

    function check_login($un,$pw){
        $this->db->where('r_username',$un);
        $this->db->where('r_password',$pw);
        $this->db->where('active_stts',1);
        $query = $this->db->get('tbl_beneficiaries');
        if($query->num_rows()>0){
          $sttsarr = array(
             'stts'=> 1,
             'datas' => $query->row()
          );
          return $sttsarr;
        }else{
          $sttsarr = array(
             'stts'=> 0,
             'datas' => []
          );
          return $sttsarr;
        }
    }

    function check_feedback_exists($eventid,$regid){
        $this->db->where('event_id',$eventid);
        $this->db->where('registration_id',$regid);
        $query = $this->db->get('tbl_advance_feedback');
        if($query->num_rows()>0){
          return 1;
        }else{
          return 0;
        }
    }

    function save_advance_feedback($instarr){
        return $this->db->insert('tbl_advance_feedback',$instarr);
    }

    function save_general_feedback($instarr){
        return $this->db->insert('tbl_open_feedback',$instarr);
    }

}