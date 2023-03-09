<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function check_login_access($username,$password){
     /* $this->db->select('*');
      $this->db->from('tbl_login');
      $this->db->where('org_username',$username);
      $this->db->where('org_password',$password);
      $this->db->where('active_stts',1);
      $query = $this->db->get(); */

      $sql = "SELECT * FROM tbl_login as a,tbl_employee as b,tbl_organization as c WHERE a.org_id=c.org_id AND a.emp_id=b.emp_id AND org_username='$username' AND org_password='$password' AND a.active_stts=1";
      $query = $this->db->query($sql);

      if($query->num_rows()>0){
      	return $query->row();
      }else{
      	return [];
      }
    }


}   