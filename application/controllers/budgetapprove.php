<?php

class Budgetapprove extends CI_Controller {

    public $data;
    public $filter;
    public $limit = 10;

    public function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'Budgetapprove/');
        $this->data = array();
        init_generic_dao();
        $this->load->model(array('m_budget_request', 'm_budget_approve','m_task'));
        $this->load->library(array('template_admin'));
        $this->logged_in();
        $this->data['page_title'] = "Approve Budget";
    }

    private function validate() {
        $this->form_validation->set_rules('nominal', 'nominal', 'trim');
        $this->form_validation->set_rules('tgl_request', 'tgl_request', 'trim');
        return $this->form_validation->run();
    }

    /**
      prepare data for view
     */
    public function preload() {
        $this->data['current_context'] = CURRENT_CONTEXT;
    }

    public function index() {
        $this->preload();
        if($this->session->userdata('role_id') == "6" || $this->session->userdata('role_id') == "1"){
            $this->template_admin->display('budget_approve/budget_approve_list', $this->data);
        }else{
            redirect('dashboard');
        }
       
    }

    public function get_list(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search= strtoupper($_REQUEST['search']["value"]);
        $list= $this->m_budget_approve->get_all();
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=count($list);
        $output['recordsFiltered']=count($list);
        $output['data']=array();
        if($search!=""){
            $search= "AND b.full_name like '%".$search."%'";
        }
        $query=$this->m_budget_approve->get_data($length,$start,$search);
        if($search!=""){
            $jum=$this->m_budget_approve->get_data($length,$start,$search);
            $query=$this->m_budget_approve->get_data($length,$start,$search);
            $output['recordsTotal']=$output['recordsFiltered']=count($jum);
        }
        $nomor_urut=$start+1;
        foreach ($query as $row) {
          // $button='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detailRequest('."'".$row->id."'".')"><i class="glyphicon glyphicon-eye-open"></i></a>';
           if($row->status == "Rejected"){
                $button='<a class="btn btn-sm btn-danger" href="#"onclick=detailRequest("'.$row->id.'")><i class="glyphicon glyphicon-eye-open"></i></a></a>';
            }elseif($row->status == "Approved"){
                $button='<a class="btn btn-sm btn-success" href="#"onclick=detailRequest("'.$row->id.'")><i class="glyphicon glyphicon-eye-open"></i></a></a>';
            }else{
                $button='<a class="btn btn-sm btn-warning" href="#" onclick=detailRequest("'.$row->id.'")><i class="glyphicon glyphicon-eye-open"></i></a></a>';
            }
           $nominal = "Rp.".number_format($row->nominal); 
           $output['data'][]=array($nomor_urut,
                                  $row->no_request,
                                  $row->full_name,
                                  $nominal,
                                  date("d-M-Y", strtotime($row->tgl_request)),
                                  $row->status,
                                  $button
                                );
            $nomor_urut++;
        }
        echo json_encode($output);
    }

    public function getRequestById($id){
        $data = $this->m_budget_request->get_by_id($id);
        if($data[0]->status == "Processed" || $data[0]->status == "Pending" ){
             $this->m_budget_request->change_status($id,'Processed');
        }
        echo json_encode($data);
    }

    public function do_approve(){
        $id = $this->input->post('id');
        $tgl_action = $this->input->post('tgl_action');
        $approve = $this->m_budget_approve->save_approve($id,$tgl_action);
        $save_task = $this->m_task->save_supervisor($id,'APPROVE');
        if($approve){
             echo json_encode(array("status" => TRUE));
         }else{
             echo json_encode(array("status" => FALSE));
         }
    }

    public function do_reject(){
        $id = $this->input->post('id');
        $tgl_action = $this->input->post('tgl_action');
        $approve = $this->m_budget_approve->save_reject($id,$tgl_action);
        $save_task = $this->m_task->save_supervisor($id,'REJECT');
        if($approve){
             echo json_encode(array("status" => TRUE));
         }else{
             echo json_encode(array("status" => FALSE));
         }
    }
    
   
    function logged_in() {
        if (!($this->session->userdata('logged_in'))) {
             redirect(base_url() . "auth");
        }
    }

}

?>