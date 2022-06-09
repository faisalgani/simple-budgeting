<?php
class M_setting_limit extends Generic_dao {

    public function table_name() {
        return Tables::$setting_limit;
    }

    public function field_map() {
        return array(
            'id' => 'id',
            'jml_limit' => 'jml_limit',
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

    public function get_limit(){
        $query=$this->ci->db->query("SELECT jml_limit FROM setting_limit")->row()->jml_limit;
        return $query;
    }

}

?>