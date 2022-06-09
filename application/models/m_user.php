<?php
class M_user extends Generic_dao {

    public function table_name() {
        return Tables::$users;
    }

    public function field_map() {
        return array(
            'id_user' => 'id_user',
            'role_id' => 'role_id',
            'full_name' => 'full_name',
            'username' => 'username',
            'password' => 'password',
            'is_login' =>'is_login',
            'updated_by'=>'updated_by',
            'updated_at'=>'updated_at',
            'created_by'=>'created_by',
            'created_at'=>'created_at',
            'is_deleted'=>'is_deleted'
           
        );
    }

    public function __construct() {
        parent::__construct();
    }

   
    public function check_login($username, $pass) {
        $password = md5($pass);
        $query = $this->ci->db->query("select * from users where username='$username' and password='$password'");
        return $query->row() ;
    }

   
    public function delete_data($obj,$id){
        $array= array(
            'updated_by' => $obj['updated_by'],
            'updated_at' => $obj['updated_at'],
            'is_deleted' => 1 );
        $this->ci->db->where('id_user',$id['id_user']);
        $query=$this->ci->db->update('users',$array);
    }
    
    
    public function joined_table() {
        return array(
            array(
                'table_name' => Tables::$role,
                'condition' => Tables::$role . '.role_id = ' . $this->table_name() . '.role_id',
                'field' => 'role_name'
            )
        );
    }

    public function update_data($obj, $obj_id){
        $this->ci->db->where($obj_id);
        $this->ci->db->update('users',$obj);
    }
}

?>