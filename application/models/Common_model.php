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
        $this->db->join('tbl_district','tbl_organization.org_district=tbl_district.destrict_id','left');
    	$query = $this->db->get('tbl_organization');

    	if($query->num_rows()>0){
    		return $query->result();
    	}else{
    		return [];
    	}
    }

    function get_all_organization_list_active($ids){
        if($ids==2){
          $this->db->where('org_id',$this->session->userdata('org_id'));  
        }
        $this->db->where('org_stts',1);
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
            $sql = "SELECT * FROM tbl_employee AS te,tbl_organization AS tos,tbl_designation AS tdesg,tbl_district AS tdis WHERE te.emp_designation=tdesg.designation_id AND te.base_station=tdis.destrict_id AND te.org_id=tos.org_id AND te.org_id='$orgid'";
        }else{
            $sql = "SELECT * FROM tbl_employee AS te,tbl_organization AS tos ,tbl_designation AS tdesg,tbl_district AS tdis WHERE te.emp_designation=tdesg.designation_id AND te.base_station=tdis.destrict_id AND te.org_id=tos.org_id";
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

    function get_locations(){
        //return $this->db->get('tbl_location')->result();
        return $this->db->get('tbl_gn_division')->result();
    }

    function check_donor_have_records($curyear,$donorid){
        $this->db->select('*');
        $this->db->from('tbl_donor_stages');
        $this->db->where('donor_id',$donorid);
        $this->db->where('financial_year',$curyear);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return [];
        }
    }

    function update_donor_stage($upddonorstage,$donor_stage_id){
        $this->db->where('donor_stage_id',$donor_stage_id);
        return $this->db->update('tbl_donor_stages',$upddonorstage);
    }

    function add_donor_stage($instdonorstg){
        return $this->db->insert('tbl_donor_stages',$instdonorstg);
    }

    function add_new_donor($dnrarr){
        return $this->db->insert('tbl_donor',$dnrarr);
    }

    function list_donors(){
        return $this->db->get('tbl_donor')->result();
    }

    function get_donor_stages($dnrid){
        $this->db->where('donor_id',$dnrid);
        $this->db->order_by('financial_year','DESC');
        $query = $this->db->get('tbl_donor_stages');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function update_donor($upddnr,$donorid){
        $this->db->where('donor_id',$donorid);
        return $this->db->update('tbl_donor',$upddnr);
    }

    function get_curent_donor_details($donor_id){
       $this->db->where('donor_id',$donor_id); 
       return $this->db->get('tbl_donor')->row();
    }

    function get_title(){
        $query = $this->db->get('tbl_title');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function get_gn_divsions(){
         $query = $this->db->get('tbl_gn_division');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }

    function check_login_exists($un,$pw){
        $this->db->where('r_username',$un);
        $this->db->where('r_password',$pw);
        $query = $this->db->get('tbl_beneficiaries');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    function insert_beneficiary($beni){
        $this->db->insert('tbl_beneficiaries',$beni);
        return $this->db->insert_id();
    }

    function get_beneficiary(){
       $this->db->select('*');
       $this->db->from('tbl_beneficiaries as a');
       $this->db->join('tbl_title as b','a.title_id=b.title_id','left');
       $this->db->join('tbl_organization as c','a.org_id=c.org_id','left');
       $this->db->join('tbl_gn_division as d','a.gn_division=d.gn_div_id','left');
       $this->db->where('a.approve_stts',1);
       if($this->session->userdata('org_type')==2){
        $this->db->where('a.org_id',$this->session->userdata('org_id'));
       }
       $query = $this->db->get();
       if($query->num_rows()>0){
        return $query->result();
       }else{
        return [];
       }
    }

    function update_beneficiary($updbeneficiary,$benid){
        $this->db->where('reg_id',$benid);
        return $this->db->update('tbl_beneficiaries',$updbeneficiary);
    }

    function get_proj_count1($orgid,$type){
       if($type==2){
        $this->db->where('org_id',$orgid);
       }
       
       $query = $this->db->get('tbl_project');
       if($query->num_rows()>0){
        return $query->num_rows();
       }else{
        return 0;
       } 
    }

    function get_comparison($sttsid,$project_count){
       if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
       }
       $this->db->where('tbl_project.proj_stts',$sttsid);
       $query = $this->db->get('tbl_project');
       $prjcount = $query->num_rows();
       
       return $prjcount;
    }

    function get_year_donations($yr){
        $this->db->select('sum(proj_budget) as ttl_donation');
        if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
        }
        $this->db->where('YEAR(project_start_date)',$yr);
        $query = $this->db->get('tbl_project');
        
        if($query->num_rows()>0){
            return $query->row()->ttl_donation;
        }else{
            return 0;
        }
    }

    function get_all_project_by_stts($stts){
        if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
       }
       $this->db->where('tbl_project.proj_stts',$stts);
       $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
        $this->db->join('tbl_donor','tbl_project.donor_id=tbl_donor.donor_id');
       $query = $this->db->get('tbl_project');
       if($query->num_rows()>0){
         return $query->result();
       }else{
        return [];
       }
    }

      function get_all_project_by_stats($project_sts){
        if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
       }
       $this->db->where('tbl_project.project_status',$project_sts);
       $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
        $this->db->join('tbl_donor','tbl_project.donor_id=tbl_donor.donor_id');
       $query = $this->db->get('tbl_project');
       if($query->num_rows()>0){
         return $query->result();
       }else{
        return [];
       }
    }

    function get_all_project_by_balance_donations($stts){
       $whr = "";
       if($stts==1){
        $whr = "balance_budget<=100000";
       }else if($stts==2){
        $whr = "balance_budget>100000 and balance_budget<=200000";
       }else if($stts==3){
        $whr = "balance_budget > 200000 and balance_budget <= 500000";
       }else{
        $whr = "balance_budget > 500000";
       }

       if($this->session->userdata('org_type')==2){
           $this->db->where('tbl_project.org_id',$this->session->userdata('org_id')); 
       }
       $this->db->where($whr);
       
       $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
        $this->db->join('tbl_donor','tbl_project.donor_id=tbl_donor.donor_id');
       $query = $this->db->get('tbl_project');
       if($query->num_rows()>0){
         return $query->result();
       }else{
        return [];
       }
    }

    function get_ratings_count_total($id){
      $sql = "SELECT a.event_id,count(adv_feedback_id) as total_feedbacks FROM tbl_advance_feedback AS a,tbl_event AS b WHERE a.event_id=b.event_id AND a.event_id='$id'";
      $query = $this->db->query($sql);
      if($query->num_rows()>0){
        return $query->row()->total_feedbacks;
      }else{
        return 0;
      }
    }

    function get_ratings_count($id,$type){
       $sql = "SELECT a.event_id,count(adv_feedback_id) as total_feedbacks FROM tbl_advance_feedback AS a,tbl_event AS b WHERE a.event_id=b.event_id AND a.event_id='$id' AND a.feedback_cat_id='$type'";
      $query = $this->db->query($sql);
      if($query->num_rows()>0){
        return $query->row()->total_feedbacks;
      }else{
        return 0;
      }
    }

    function update_logins($bid,$beni){
      $this->db->where('reg_id',$bid);
      return $this->db->update('tbl_beneficiaries',$beni);
    }

    function open_feedbacks(){
      $this->db->select('*');
      $this->db->from('tbl_open_feedback');
      $this->db->join('tbl_beneficiaries','tbl_open_feedback.registration_id=tbl_beneficiaries.reg_id');
      $this->db->order_by('tbl_open_feedback.open_feedback_id','DESC');
      $query = $this->db->get();
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function save_complain_cats($compcatarr){
      return $this->db->insert('tbl_complain_category',$compcatarr);
    }

    function get_complain_cats(){
      $query = $this->db->get('tbl_complain_category');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function save_complains($compcatarr){
      return $this->db->insert('tbl_complain',$compcatarr);
    }

    function get_complains_by_cat($stts,$compcatid){
      $this->db->select('*');
      $this->db->from('tbl_complain as a');
      $this->db->join('tbl_organization as b','a.org_id=b.org_id');
      $this->db->join('tbl_complain_category as c','a.compln_cat_id=c.compln_cat_id');
       
      if($this->session->userdata('org_type')==2){
           $this->db->where('a.org_id',$this->session->userdata('org_id')); 
       }

      if($compcatid){
        $this->db->where('a.compln_cat_id',$compcatid);
      }

      if($stts){
        $this->db->where('a.complain_stts',$stts);
      }

      $query = $this->db->get();
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }

    }

    function complain_data($id){
      $this->db->where('compln_id',$id);
      $query = $this->db->get('tbl_complain');
      return $query->row();
    }

    function complain_followups_data($id){
      $this->db->where('complain_id',$id);
      $this->db->order_by('compln_flwup_id','DESC');
      $this->db->join('tbl_login','tbl_complain_followpu.followup_by=tbl_login.user_id','left');
      $this->db->join('tbl_employee','tbl_login.emp_id=tbl_employee.emp_id','left');
      $query = $this->db->get('tbl_complain_followpu');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function add_followups($addfu){
      return $this->db->insert('tbl_complain_followpu',$addfu);
    }

    function update_complains($upd,$id){
      $this->db->where('compln_id',$id);
      $this->db->update('tbl_complain',$upd);
    }

    function get_desigations(){
      $query = $this->db->get('tbl_designation');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function get_base_station(){
      $query = $this->db->get('tbl_district');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function add_data($tbl,$addrecord){
      return $this->db->insert($tbl,$addrecord);
    }

    function update_recrod($tbl,$flds,$updrecord,$gndivid){
      $this->db->where($flds,$gndivid);
      return $this->db->update($tbl,$updrecord);
    }

    function count_pending_benificiary(){
      if($this->session->userdata('org_type')==1){
        $this->db->where('approve_stts',0);
        $query = $this->db->get('tbl_beneficiaries');
        if($query->num_rows()>0){
          return $query->num_rows();
        }else{
          return 0;
        }
      }else{
        return 0;
      }
      
    }

    function get_pending_benificiries(){
      if($this->session->userdata('org_type')==1){
        
        $this->db->select('*');
        $this->db->from('tbl_beneficiaries as a');
        $this->db->join('tbl_title as b','a.title_id=b.title_id','left');
        $this->db->join('tbl_organization as c','a.org_id=c.org_id','left');
        $this->db->join('tbl_gn_division as d','a.gn_division=d.gn_div_id','left');
        $this->db->where('a.approve_stts',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
          return $query->result();
        }else{
          return [];
        }
      }else{
        return [];
      }
    }

    function count_pending_projects(){
      if($this->session->userdata('org_type')==1){
        $this->db->select('*');
        $this->db->from('tbl_project');
        $this->db->join('tbl_organization','tbl_project.org_id=tbl_organization.org_id');
        $this->db->join('tbl_donor','tbl_project.donor_id=tbl_donor.donor_id');
        $this->db->where('tbl_project.proj_stts',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
          return $query->num_rows();
        }else{
          return 0;
        }
      }else{
        return 0;
      }
    }

    function count_pending_events(){
      if($this->session->userdata('org_type')==1){
        $this->db->select('*');
        $this->db->from('tbl_event');
        $this->db->where('tbl_event.event_stts',0);
        $query = $this->db->get();
        if($query->num_rows()>0){
          return $query->num_rows();
        }else{
          return 0;
        }
      }else{
        return 0;
      }
    }

    function get_login_not_created_emps(){
       $sql = "SELECT * FROM tbl_employee,tbl_organization WHERE tbl_employee.emp_id NOT IN ( SELECT emp_id FROM tbl_login ) AND tbl_employee.org_id=tbl_organization.org_id";
       $query = $this->db->query($sql);
       if($query->num_rows()>0){
        return $query->result();
       }else{
        return [];
       }
    }

    function usertypes(){
      return $this->db->get('tbl_user_type')->result();
    }

    function add_login_details($loginarr){
      return $this->db->insert('tbl_login',$loginarr);
    }

    function update_password($updarr){
      $this->db->where('emp_id',$this->session->userdata('emp_id'));
      return $this->db->update('tbl_login',$updarr);
    }

    function get_date_related_event_details($fromd,$tod){
      $this->db->select('count(registration_id) as benicount,a.*,b.*,c.*');
      $this->db->from('tbl_child_event as a');
      $this->db->join('tbl_event as b','a.event_id=b.event_id');
      $this->db->join('tbl_project as c','b.proj_id=c.proj_id');
      $where = " b.event_date BETWEEN '$fromd' AND '$tod'";
      $this->db->where($where);
      $this->db->group_by('a.event_id');
      $query = $this->db->get();
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function get_event_detail($id){
      $this->db->where('event_id',$id);
      $query = $this->db->get('tbl_event');
      return $query->row();
    }

   /* function benificiarylist($id){
      $sql = "SELECT * FROM tbl_beneficiaries AS a,tbl_title AS b WHERE a.title_id=b.title_id AND a.reg_id NOT IN (SELECT registration_id from tbl_child_event WHERE event_id='$id')";
      $query = $this->db->query($sql);
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    } */

     function benificiarylist($id){
      $sql = "SELECT * FROM tbl_beneficiaries AS a WHERE a.reg_id NOT IN (SELECT registration_id from tbl_child_event WHERE event_id='$id')";
      $query = $this->db->query($sql);
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function get_event_assign_beneficiary($id){
      $this->db->select('*');
      $this->db->from('tbl_child_event as a');
      $this->db->join('tbl_beneficiaries as b','a.registration_id=b.reg_id');
      $this->db->join('tbl_title as c','b.title_id=c.title_id');
      $this->db->where('a.event_id',$id);
      $query = $this->db->get();
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }

    function add_event_benificiary_register($addeventbeni){
      return $this->db->insert('tbl_child_event',$addeventbeni);
    }


     function get_gn_divsions_wise_benificiaries_count($id){
        $this->db->select('*');
        $this->db->from('tbl_beneficiaries AS a');
        $this->db->where('a.gn_division',$id);

        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->num_rows();
        }else{
            return 0;
        }
    }

    function get_employee_data($id){
        $this->db->where('a.emp_id',$id);
        $this->db->join('tbl_organization as b','a.org_id=b.org_id');
        $this->db->join('tbl_designation as c','a.emp_designation=c.designation_id');
        $this->db->join('tbl_district as d','a.base_station=d.destrict_id');
        $query = $this->db->get('tbl_employee as a');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return [];
        }
    }


    function get_beneficiary_details($benid){
      $this->db->where('reg_id',$benid);
      $query = $this->db->get('tbl_beneficiaries');
      return $query->row();
    }

    function update_benificiaries($beni,$regid){
      $this->db->where('reg_id',$regid);
      return $this->db->update('tbl_beneficiaries',$beni);
    }

    function get_project_data($projid){
      $this->db->select('*');
      $this->db->from('tbl_project as a');
      $this->db->join('tbl_organization as b','a.org_id=b.org_id');
      $this->db->where('a.proj_id',$projid);
      $query = $this->db->get();
      return $query->row();
    }

    function get_event_data($id){
      $this->db->select('*');
      $this->db->from('tbl_event as c');
      $this->db->join('tbl_project as a','c.proj_id=a.proj_id');
      $this->db->join('tbl_organization as b','a.org_id=b.org_id');
      $this->db->where('c.event_id',$id);
      $query = $this->db->get();
      return $query->row();
    }

    function get_proj_rel_org($projid){
        $this->db->select('*');
      $this->db->from('tbl_project as a');
      $this->db->join('tbl_organization as b','a.org_id=b.org_id');
      $this->db->where('a.proj_id',$projid);
      $query = $this->db->get();
      return $query->row();
    }

    function get_selected_donor_balaces($donorid){
        $this->db->select('sum(balance_budget) as donor_donation_balance');
        $this->db->from('tbl_project');
        $this->db->where('donor_id',$donorid);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row()->donor_donation_balance;
        }else{
            return 0;
        }
    }

    function check_event_exists($evestart,$elocation){
        $this->db->where('event_date',$evestart);
        $this->db->where('location',$elocation);
        $query = $this->db->get('tbl_event');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    function check_exist($shortcode){
        $this->db->where('short_code',$shortcode);
        $query = $this->db->get('tbl_organization');
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    function get_benificiary_event_participation_count($reg_id){
        $this->db->select('*');
        $this->db->from('tbl_child_event');
        $this->db->where('registration_id',$reg_id);
        $query=$this->db->get();
        if($query->num_rows()>0){
            return $query->num_rows();
        }else{
            return 0;
        }
    }

    function get_financial_yearwise_awards($y){
        $this->db->where('financial_year',$y);
        $this->db->join('tbl_donor','tbl_donor_stages.donor_id=tbl_donor.donor_id');
        $query = $this->db->get('tbl_donor_stages');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return [];
        }
    }


     function get_privilages($user_level){
      $this->db->where('user_type_id',$user_level);
      $query = $this->db->get('tbl_user_privilage');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
     }

    // gn division change benificary select model..
     function get_related_beneficiaries($gndiv){
        $this->db->where('gn_division',$gndiv);
        $query = $this->db->get('tbl_beneficiaries');
        if($query->num_rows()>0){
          return $query->result();
        }else{
          return [];
        }
     }

    /* function get_event_data($id){
        $this->db->where('event_id',$id);
        return $this->db->get('tbl_event')->row();
     } */
     
     function update_event_data($evearr,$evid){
        $this->db->where('event_id',$evid);
        return $this->db->update('tbl_event',$evearr);
     }


      function get_qulaity(){
      $query = $this->db->get('tbl_qulaity');
      if($query->num_rows()>0){
        return $query->result();
      }else{
        return [];
      }
    }
    

}   