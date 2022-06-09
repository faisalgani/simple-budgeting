<?php
class m_task extends CI_Model   {

     var $table = 'task';
   
    public function __construct() {
        parent::__construct();
    }

    public function get_all($where_flag){
        if($where_flag == "WHERE a.flag = '1'"){
            $id_user = "AND a.notif_to = '".$this->session->userdata('id_user')."'"; 
        }else{
            $id_user = "";
        }
        $query=$this->db->query("SELECT * FROM  task a INNER JOIN users b ON a.notif_to = b.id_user INNER JOIN budget_request c on a.id_budget=c.id $where_flag $id_user ORDER BY a.created_at DESC ")->result();
        return $query;
    }

    public function get_data($length,$start,$search,$where_flag){
        if($where_flag == "WHERE a.flag = '1'"){
            $id_user = "AND a.notif_to = '".$this->session->userdata('id_user')."'"; 
        }else{
            $id_user = "";
        }
         $query=$this->db->query("SELECT * FROM  task a INNER JOIN users b ON a.notif_to = b.id_user INNER JOIN budget_request c on a.id_budget=c.id $where_flag $id_user $search  ORDER BY a.created_at DESC 
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
        $id_budget = $this->db->query("SELECT id from budget_request WHERE no_request ='".$data['no_request']."' ")->row()->id;
        $find_supervisor = $this->db->query("SELECT * FROM users WHERE role_id ='6' LIMIT 1")->row();
        $task = "Request Budget Dari ".$this->session->userdata('full_name')." Dengan Nomor <a href=# onclick=detailRequest(".$id_budget.")>".$data['no_request']."</a>";
        $val = array('id_budget' => $id_budget,
                     'task'=> $task,
                     'notif_to' =>$find_supervisor->id_user,
                     'created_by' => $this->session->userdata('full_name'),
                     'created_at' => date("Y-m-d"),
                     'flag' => 0);
        $save = $this->db->insert('task', $val);
        if($save){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    public function save_supervisor($id_budget,$status){
        $data_budget = $this->db->query("SELECT * from budget_request WHERE id ='".$id_budget."' ")->row();
        $find_user   = $this->db->query("SELECT * from users WHERE id_user ='".$data_budget->id_user."' ")->row();
        if($status == "APPROVE"){
            $task = "Request Budget Dari ".$find_user->full_name."  Dengan Nomor <a href=# onclick=detailRequestUser(".$id_budget.")>".$data_budget->no_request."</a> Telah Di Setujui Oleh Supervisor ".$this->session->userdata('full_name');
        }else{
             $task = "Request Budget Dari ".$find_user->full_name."  Dengan Nomor <a href=# onclick=detailRequestUser(".$id_budget.")>".$data_budget->no_request."</a> Tidak Di Setujui Oleh Supervisor ".$this->session->userdata('full_name');
        }
        $val = array('id_budget' => $id_budget,
                     'task'=> $task,
                     'notif_to' =>$data_budget->id_user,
                     'created_at' => date("Y-m-d"),
                     'created_by' => $this->session->userdata('full_name'),
                     'flag' => 1);
        $save = $this->db->insert('task', $val);
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
        $change = $this->db->update('task', $data, $where);
        if($change){
            $this->db->trans_commit();
        }else{
            $this->db->trans_rollback();
        }
    }    
}

?>