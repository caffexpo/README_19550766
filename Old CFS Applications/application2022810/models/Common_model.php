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

    function get_organization_detail($id){
        $this->db->where('org_id',$id);
        $query = $this->db->get('tbl_organization');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return [];
        }
    }

    function get_employee_list($id){
        if($id==2){
            $orgid = $this->session->userdata('org_id');
            $sql = "SELECT * FROM tbl_employee AS te,tbl_organization AS tos WHERE te.org_id=tos.org_id AND te.org_id='$orgid'";
        }else{
            $sql = "SELECT * FROM tbl_employee AS te,tbl_organization AS tos WHERE te.org_id=tos.org_id";
        }
        
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }

    }

    function check_privilage($pageid,$user,$cat){
        $this->db->where('page_id',$pageid);
        $this->db->where('user_type_id',$user);
        //$this->db->where('org_id',$cat);
        $query = $this->db->get('tbl_user_privilage');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }

    }

    function update_organization($orgarr,$org_id){
        $this->db->where('org_id',$org_id);
        return $this->db->update('tbl_organization',$orgarr);
    }

    function get_employee_details($id){
        $this->db->where('emp_id',$id);
        $query = $this->db->get('tbl_employee');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return [];
        }
    }

    function update_employee($emparr,$emp_id){
        $this->db->where('emp_id',$emp_id);
        return $this->db->update('tbl_employee',$emparr);
    }

    function check_login_exist($emp_id){
        $this->db->where('emp_id',$emp_id);
        $query = $this->db->get('tbl_login');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    function update_login($updlogin,$emp_id){
        $this->db->where('emp_id',$emp_id);
        return $this->db->update('tbl_login',$updlogin);
    }

    function get_user_types($id){
        if($id){
          $this->db->where('user_type_id',$id);  
          $query = $this->db->get('tbl_user_type');
            if($query->num_rows()>0){
                return $query->row();
            }else{
                return [];
            }
        }else{
            $query = $this->db->get('tbl_user_type');
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return [];
            }
        }
        
    }

    function get_pages(){
        $query = $this->db->get('tbl_pages');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function get_user_type_rel_privilages($usertypeid){
        $this->db->where('user_type_id',$usertypeid);
        $query = $this->db->get('tbl_user_privilage');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function delete_old_privilages($privid){
        $this->db->where('user_type_id',$privid);
        return $this->db->delete('tbl_user_privilage');
    }

    function insert_new_privilages($privarr){
        return $this->db->insert('tbl_user_privilage',$privarr);
    }

    function get_org_count(){
        $this->db->select('*');
        $this->db->from('tbl_organization');
        $this->db->where('org_stts',1);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->num_rows();
        }else{
            return 0;
        }
    }

    function get_emp_count($orgid,$type){
       if($type==2){
        $this->db->where('org_id',$orgid);
       }
       $this->db->where('active_stts',1);
       $query = $this->db->get('tbl_employee');
       if($query->num_rows()>0){
        return $query->num_rows();
       }else{
        return 0;
       }
    }

    function get_proj_count($orgid,$type){
       if($type==2){
        $this->db->where('org_id',$orgid);
       }
       $this->db->where('proj_stts',1);
       $query = $this->db->get('tbl_project');
       if($query->num_rows()>0){
        return $query->num_rows();
       }else{
        return 0;
       } 
    }

    function get_event_count($orgid,$type){
       $this->db->select('*');
       $this->db->from('tbl_project');
       $this->db->join('tbl_event','tbl_project.proj_id=tbl_event.proj_id');
       $this->db->where('tbl_event.event_stts',1);
       if($type==2){
        $this->db->where('tbl_project.org_id',$orgid);
       }
       $query = $this->db->get();
       if($query->num_rows()>0){
        return $query->num_rows();
       }else{
        return 0;
       } 
    }

    function get_donors(){
        $this->db->where('donor_stts',1);
        $query = $this->db->get('tbl_donor');
        if($query->num_rows()>0){
        return $query->result();
       }else{
        return [];
       } 
    }

    function insert_new_project($projarr){
       return $this->db->insert('tbl_project',$projarr); 
    }

    function get_all_project_list_for_approval($id){
        $this->db->select('*');
        $this->db->from('tbl_project');
        $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
        $this->db->join('tbl_donor','tbl_project.donor_id=tbl_donor.donor_id');
        if($id==1){
            $this->db->where('tbl_project.proj_stts',0);
        }

        if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
        }
        
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function update_projects($upd_project,$projid){
        $this->db->where('proj_id',$projid);
        return $this->db->update('tbl_project',$upd_project);
    }

    function get_all_projects_list($id){
      if($id==2){
        $this->db->where('tbl_project.org_id',$this->session->userdata('org_id'));
      }
      $this->db->where('tbl_project.proj_stts',1);
      $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
      $query = $this->db->get('tbl_project');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function insert_new_event($evearr){
        return $this->db->insert('tbl_event',$evearr);
    }

    function get_related_event_list($id,$type,$aprvtype){
        $this->db->select('*');
        $this->db->from('tbl_event');
        $this->db->join('tbl_project','tbl_event.proj_id=tbl_project.proj_id');

        if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
        }

        if($aprvtype==0){
            $this->db->where('tbl_event.event_stts',0);
        }

        if($id!=""){
          $this->db->where('tbl_event.proj_id',$id);
        }

        if($type==0){
          $this->db->where('tbl_event.event_stts',0); 
        }
        
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function update_events($id,$updevent){
        $this->db->where('event_id',$id);
        return $this->db->update('tbl_event',$updevent);
    }

}   