<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
            return false;
        }
    }



}