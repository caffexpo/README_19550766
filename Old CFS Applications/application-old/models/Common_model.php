<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert_new_organization($orgarr){
    	return $this->db->insert('tbl_organization',$orgarr);
    }

    function insert_new_employee($emparr){
        return $this->db->insert('tbl_employee',$emparr);
    }

    function get_all_organization_list($ids){
        if($ids==2){
          $this->db->where('org_id',$this->session->userdata('org_id'));  
        }
    	$query = $this->db->get('tbl_organization');
    	if($query->num_rows()>0){
    		return $query->result();
    	}else{
    		return [];
    	}
    }

    function get_employee_list(){
        $sql = "SELECT * FROM tbl_employee AS te,tbl_organization AS tos WHERE te.org_id=tos.org_id";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }

    }

    function check_privilage($pageid,$user,$cat){
        $this->db->where('page_id',$pageid);
        $this->db->where('user_id',$user);
        //$this->db->where('org_id',$cat);
        $query = $this->db->get('tbl_user_privilage');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }

    }

}   