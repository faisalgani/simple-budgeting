<?php

class Budgetrequest extends CI_Controller {

    public $data;
    public $filter;
    public $limit = 10;

    public function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'Budgetrequest/');
        $this->data = array();
        init_generic_dao();
        $this->load->model(array('m_budget_request', 'm_task','m_setting_limit'));
        $this->load->library(array('template_admin'));
        $this->logged_in();
        $this->data['page_title'] = "Request Budget";
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
        if($this->session->userdata('role_id') == "5" || $this->session->userdata('role_id') == "1"){
            $this->template_admin->display('budget_request/budget_request_list', $this->data);
        }else{
            redirect('dashboard');
        }
       
    }

    
    private function fetch_input() {
        $data = array(
            'id_user' => $this->session->userdata('id_user'),
            'nominal' => str_replace(".", "", $this->input->post('nominal')),
            'tgl_request' => $this->input->post('tgl_request'),
            'deskripsi' => htmlentities($_POST['deskripsi']),
            'status' => 'Pending');
        return $data;
    }
   
    public function add() {
        $obj = $this->fetch_input();
        $cek_limit = $this->m_setting_limit->get_limit();
        $jumlah_request = $this->m_budget_request->jumlah_request($this->session->userdata('id_user'));
        if($jumlah_request + $obj['nominal'] <= $cek_limit){
            $obj['no_request'] = $this->get_no_request();
            if ($this->validate() != false) {
                $save = $this->m_budget_request->save($obj);
                $save_task = $this->m_task->save($obj);
                if($save && $save_task){
                     echo json_encode(array("status" => TRUE));
                }else{
                     echo json_encode(array("status" => FALSE));
                }
            } 
        }else{
            echo json_encode(array("status" => FALSE));
        }
       
    }

    public function edit($id) {
        $obj = $this->fetch_input();
        //$obj['no_request'] = $this->input->post('no_request');
        if ($this->validate() != false) {
            $update = $this->m_budget_request->update_data($id,$obj);
            if($update){
                 echo json_encode(array("status" => TRUE));
            }else{
                 echo json_encode(array("status" => FALSE));
            }
        } 
    }

    /**
      @description
      viewing record. repopulation for every data needed for view.
     */
    public function detail($id_budget_request) {
        $obj_id = array('id_budget_request' => $id_budget_request);

        $this->preload();
        $this->fetch_record($obj_id);
        $this->template_admin->display('budget_request/budget_request_detail', $this->data);
    }

    public function delete($id_budget_request) {
        $obj_id = array('id_budget_request' => $id_budget_request);
        $obj = array('updated_by' => $this->session->budget_requestdata('budget_requestname'), 'updated_at' => date('Y-m-d H:i:s'),'is_deleted' => 1);
        $this->m_budget_request->delete_data($obj,$obj_id);
        $this->session->set_flashdata(array('message' => 'Data berhasil dihapus.', 'type_message' => 'success'));
        redirect(CURRENT_CONTEXT);
    }

    public function get_list(){
        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search= strtoupper($_REQUEST['search']["value"]);
        $list= $this->m_budget_request->get_all();
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=count($list);
        $output['recordsFiltered']=count($list);
        $output['data']=array();
        if($search!=""){
            $search= "AND a.no_request ='%".$search."%' ";
        }
        $query=$this->m_budget_request->get_data($length,$start,$search);
        if($search!=""){
            $jum=$this->m_budget_request->get_data($length,$start,$search);
            $query=$this->m_budget_request->get_data($length,$start,$search);
            $output['recordsTotal']=$output['recordsFiltered']=$jum->num_rows();
        }
        $nomor_urut=$start+1;
        foreach ($query as $row) {
           if($row->status == "Pending"){
                $disabled = '';
           }else{
                $disabled = 'disabled';
           }
           $button='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="detailRequestUser('."'".$row->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" '.$disabled.' href="javascript:void(0)" title="Hapus"  onclick="deleteRequest('."'".$row->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
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

     public function get_no_request(){
        $query = $this->m_budget_request->get_last_id();
        if($query == null){
            $retVal= 1;
        }else{
            $retVal= $query+1;
        }
        if (strlen($retVal) == 1) {
            $retValreal = "000000".$retVal;
        }else if (strlen($retVal) == 2){
            $retValreal = "00000".$retVal;
        }else if (strlen($retVal) == 3){
            $retValreal = "0000".$retVal;
        }else if (strlen($retVal) == 4){
            $retValreal = "000".$retVal;
        }else if (strlen($retVal) == 5){
            $retValreal = "00".$retVal;
        }else if (strlen($retVal) == 6){
            $retValreal = "0".$retVal;
        }else{
            $retValreal = $retVal;
        }
        return date("Ym").'/REQ/'.$retValreal;
    }

    public function getRequestById($id){
        $data = $this->m_budget_request->get_by_id($id);
        echo json_encode($data);
    }
    
    public function get_notif(){
        $output="";
        $request_budget = $this->m_budget_request->get_notif();
        foreach ($request_budget as  $key) {
             $str_notif = $key->full_name." Sebesar Rp .".number_format($key->nominal); 
             $output .= '
              <ul class="menu">
                 <li> <a href="#">
                    <i class="fa fa-warning text-yellow"></i> Request Budget Dari '.$str_notif.' </a>
                 </li>
              </ul>';
        }
        $data = array(
           'notification' => $output,
           'count'  => count($request_budget),
        );
        echo json_encode($data);
    }    

    function logged_in() {
        if (!($this->session->userdata('logged_in'))) {
             redirect(base_url() . "auth");
        }
    }

}

?>