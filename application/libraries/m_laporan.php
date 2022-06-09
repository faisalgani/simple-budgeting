<?php
class M_laporan extends Generic_dao {

    public function table_name() {
        return Tables::$user;
    }

    public function field_map() {
        return array(
            'id_laporan' => 'id_laporan',
            'bulan' => 'bulan',
            'tahun' => 'tahun',
            'id_user' => 'id_user',
            'jumlah' => 'jumlah',
            'created_at' => 'created_at',
            'created_by' => 'created_by',
            'updated_at' => 'updated_at',
            'updated_by' => 'updated_by',
            'is_deleted' => 'is_deleted',

           
        );
    }

    public function __construct() {
        parent::__construct();
    }
   
    
    public function joined_table() {
        return array(
            array(
                'table_name' => Tables::$master_laporan,
                'condition' => Tables::$master_laporan . '.id_laporan = ' . $this->table_name() . '.id_laporan',
                'field' => 'master_laporan'
            )
        );
    }
}

?>