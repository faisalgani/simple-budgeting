<?php

class Notification extends CI_Controller {

    public $data;
    public $filter;
    public $limit = 10;

    public function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'notification/');
        $this->data = array();
        init_generic_dao();
        $this->load->model(array('m_budget_request', 'm_budget_request','m_task'));
        $this->load->library(array('template_admin'));
        $this->logged_in();
        $this->data['page_title'] = "Notification List";
    }

    

    /**
      prepare data for view
     */
    public function preload() {
        $this->data['current_context'] = CURRENT_CONTEXT;
    }

    public function index() {
        $this->preload();
        $this->template_admin->display('task/task_list', $this->data);
    }

    

    /**
      @description
      viewing record. repopulation for every data needed for view.
     */
    public function detail($id) {
        $obj_id = array('id' => $id);

        $this->preload();
        $this->fetch_record($obj_id);
        $this->template_admin->display('task/task_detail', $this->data);
    }

    public function get_list(){
        if($this->session->userdata('role_id') == "5"){
            $flag = "WHERE a.flag = '1'";
        }elseif ($this->session->userdata('role_id') == "6") {
            $flag = "WHERE a.flag = '0'";
        }else{
           $flag = "WHERE a.flag IN ('1','0') ";
        }
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search= strtoupper($_REQUEST['search']["value"]);
        $list= $this->m_task->get_all($flag);
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=count($list);
        $output['recordsFiltered']=count($list);
        $output['data']=array();
        if($search!=""){
            $search= "AND c.status like '%".$search."%' ";
        }
        $query=$this->m_task->get_data($length,$start,$search,$flag);
        if($search!=""){
            $jum=$this->m_task->get_data($length,$start,$search,$flag);
            $query=$this->m_task->get_data($length,$start,$search,$flag);
            $output['recordsTotal']=$output['recordsFiltered']=count($jum);
        }
        $nomor_urut=$start+1;
        
        foreach ($query as $row) {
          if($this->session->userdata('role_id') == '5'){
             if($row->status == "Rejected"){
                $status='<a class="btn btn-sm btn-danger" href="#"onclick=detailRequestUser("'.$row->id_budget.'")>Rejected</a>';
             }elseif($row->status == "Approved"){
                $status='<a class="btn btn-sm btn-success" href="#"onclick=detailRequestUser("'.$row->id_budget.'")>Approved</a>';
             }else{
                $status='<a class="btn btn-sm btn-warning" href="#" onclick=detailRequestUser("'.$row->id_budget.'")>Pending</a>';
             }
          }else{
             if($row->status == "Rejected"){
                $status='<a class="btn btn-sm btn-danger" href="#"onclick=detailRequest("'.$row->id_budget.'")>Rejected</a>';
             }elseif($row->status == "Approved"){
                $status='<a class="btn btn-sm btn-success" href="#"onclick=detailRequest("'.$row->id_budget.'")>Approved</a>';
             }else{
                $status='<a class="btn btn-sm btn-warning" href="#" onclick=detailRequest("'.$row->id_budget.'")>Pending</a>';
             }
          }
          
          
           $output['data'][]=array($nomor_urut,
                                  $row->task,
                                  $status
                                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }


    function logged_in() {
        if (!($this->session->userdata('logged_in'))) {
             redirect(base_url() . "auth");
        }
    }

}

?>