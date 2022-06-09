<?php
class M_dashboard extends CI_Model {  

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_chart_summary(){
        $query=$this->db->query("SELECT b.full_name,sum(a.nominal) as nominal FROM budget_request a inner join users b on a.id_user=b.id_user
               GROUP BY a.id_user ")->result();
        return $query;
    }

    public function request_all(){
    	$query=$this->db->query("SELECT * FROM budget_request a inner join users b on a.id_user=b.id_user
               ORDER BY a.no_request DESC")->result();
        return $query;
    }

    public function jml_req(){
    	$query=$this->db->query("SELECT COUNT(*) as count, sum(nominal) as nominal FROM budget_request")->row();
        return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_acc(){
    	$query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request WHERE status ='Approved'")->row();
        return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_pend(){
    	$query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request WHERE status ='Pending'")->row();
         return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_reject(){
    	$query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request WHERE status ='Rejected'")->row();
         return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function get_chart_summary_approve(){
    	$query=$this->db->query("SELECT b.full_name,sum(a.nominal) as nominal FROM budget_request a inner join users b on a.id_user=b.id_user
               WHERE a.status = 'Approved' GROUP BY a.id_user ")->result();
        return $query;
    }


    public function request_all_staff(){
        $query=$this->db->query("SELECT * FROM budget_request a inner join users b on a.id_user=b.id_user
               WHERE a.id_user ='".$this->session->userdata('id_user')."' ORDER BY a.no_request DESC")->result();
        return $query;
    }

    public function jml_req_staff(){
        $query=$this->db->query("SELECT COUNT(*) as count, sum(nominal) as nominal FROM budget_request
            WHERE id_user ='".$this->session->userdata('id_user')."'")->row();
        return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_acc_staff(){
        $query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request  WHERE id_user ='".$this->session->userdata('id_user')."'
                AND status ='Approved'")->row();
        return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_pend_staff(){
        $query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request WHERE id_user ='".$this->session->userdata('id_user')."' 
            AND status ='Pending'")->row();
         return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function req_reject_staff(){
        $query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request WHERE id_user ='".$this->session->userdata('id_user')."'
             AND status ='Rejected'")->row();
         return $query->count.' Sejumlah, Rp.'.number_format($query->nominal);
    }

    public function get_chart_line(){
        $query=$this->db->query("SELECT a.tgl_request, SUM(a.nominal) as nominal FROM budget_request a inner join users b on a.id_user=b.id_user
               WHERE a.id_user ='".$this->session->userdata('id_user')."' GROUP BY a.tgl_request ORDER BY a.tgl_request ASC")->result();
        return $query;
    }

    public function jml_acc_staff(){
        $query=$this->db->query("SELECT COUNT(*) as count,sum(nominal) as nominal FROM budget_request  WHERE id_user ='".$this->session->userdata('id_user')."'
                AND status ='Approved'")->row();
        return $query->nominal;
    }

    public function jml_limit(){
        $query=$this->db->query("SELECT jml_limit FROM setting_limit")->row()->jml_limit;
        return $query;
    }


    
  



    
}

?>