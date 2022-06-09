<?php
class m_budget_request extends CI_Model   {

     var $table = 'budget_request';
   
    public function __construct() {
        parent::__construct();
    }

 
    public function delete_by_id($id){
        $this->db->where('no_pendaftaran', $id);
        $this->db->delete('pendaftaran');
    }


    public function get_all(){
        $query=$this->db->query("SELECT * FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user WHERE a.id_user ='".$this->session->userdata('id_user')."' ORDER BY a.tgl_request DESC ")->result();
        return $query;
    }

    public function get_data($length,$start,$search){
         $query=$this->db->query("SELECT * FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user $search AND a.id_user ='".$this->session->userdata('id_user')."' ORDER BY a.tgl_request DESC 
                LIMIT $length OFFSET $start")->result();
         return $query;
    }

    public function get_by_id($id){
        $query = $this->db->query("SELECT a.*,b.full_name,b.id_user FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user WHERE a.id ='$id'");        
        return $query->result();
    }

    public function save($data){
        $this->db->trans_begin();
        $save=$this->db->insert($this->table, $data);
        if($save){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
             return false;
        }
        
    }

    public function update_data($id,$data){
        $this->db->trans_begin();
        $this->db->where('id',$id);
        $update = $this->db->update('budget_request',$data);
        if($update){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
             return false;
        }
    }

    public function change_status($id, $status){
        $this->db->trans_begin();
        $data = array('status' => $status );
        $where = array('id' => $id );
        $change = $this->db->update($this->table, $data, $where);
        if($change){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }

    public function get_notif(){
        $query = $this->db->query("SELECT * FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user WHERE a.status ='Pending' ORDER BY a.tgl_request DESC LIMIT 5 ")->result();
        return $query;
    }

    public function get_last_id(){
        $query = $this->db->query("SELECT max(id) as id FROM budget_request")->row()->id;
        return $query;
    }

    public function jumlah_request($id){
        $query = $this->db->query("SELECT sum(nominal) as nominal FROM budget_request WHERE id_user ='".$id."'")->row()->nominal;
        return $query; 
    }
    
}

?>