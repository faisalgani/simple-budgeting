<?php
class m_budget_approve extends CI_Model   {

     var $table = 'budget_approve';
   
    public function __construct() {
        parent::__construct();
    }

    public function get_all(){
        $query=$this->db->query("SELECT * FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user ORDER BY a.no_request DESC ")->result();
        return $query;
    }

    public function get_data($length,$start,$search){
         $query=$this->db->query("SELECT * FROM  budget_request a INNER JOIN users b ON a.id_user = b.id_user $search ORDER BY a.no_request DESC 
                LIMIT $length OFFSET $start")->result();
         return $query;
    }

    public function get_by_id($id){
        $this->db->from($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get();        
        return $query->row();
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

    public function change_status($id, $status){
        $this->db->trans_begin();
        $data = array('status' => $status );
        $where = array('id' => $id );
        $change = $this->db->update('budget_request', $data, $where);
        if($change){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function save_approve($id,$tgl_action){
        $this->db->trans_begin();
        $request = $this->db->query("SELECT * FROM budget_request WHERE id='$id' ")->row();
        $data =  array(
            'id_budget' => $request->id,
            'tgl_action' => $tgl_action,
            'is_approve' => 1
         );
        $save = $this->db->insert($this->table, $data);
        $this->change_status($id,'Approved');
        if($save){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }      
    }

    public function save_reject($id,$tgl_action){
        $this->db->trans_begin();
        $request = $this->db->query("SELECT * FROM budget_request WHERE id='$id' ")->row();
        $data =  array(
            'id_budget' => $request->id,
            'tgl_action' => $tgl_action,
            'is_approve' => 0
         );
        $save = $this->db->insert($this->table, $data);
        $this->change_status($id,'Rejected');
        if($save){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }      
    }
    
}

?>