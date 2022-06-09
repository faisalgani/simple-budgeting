<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'dashboard/');
        $this->data = array();
        init_generic_dao();
         $this->load->model('m_dashboard', '', TRUE);
        $this->load->library(array('template_admin'));
        $this->logged_in();
        $this->data['page_title'] = "Dashboard";
    }

    public function preload() {
        $this->data['current_context'] = CURRENT_CONTEXT;
        $this->data['jml_req'] =  $this->m_dashboard->jml_req();
        $this->data['req_acc'] =  $this->m_dashboard->req_acc();
        $this->data['req_pend'] = $this->m_dashboard->req_pend();
        $this->data['req_reject'] = $this->m_dashboard->req_reject();
        $this->data['request_all'] = $this->m_dashboard->request_all();
        return $this->data;
    }

    public function preload_staff() {
        $this->data['current_context'] = CURRENT_CONTEXT;
        $this->data['jml_req'] =  $this->m_dashboard->jml_req_staff();
        $this->data['req_acc'] =  $this->m_dashboard->req_acc_staff();
        $this->data['req_pend'] = $this->m_dashboard->req_pend_staff();
        $this->data['req_reject'] = $this->m_dashboard->req_reject_staff();
        $this->data['request_all'] = $this->m_dashboard->request_all_staff();
        $this->data['jumlah_budget'] = $this->m_dashboard->jml_acc_staff();
        $this->data['limit_budget'] =  $this->m_dashboard->jml_limit(); 
        return $this->data;
    }
    
    public function index(){
       
        if($this->session->userdata('role_id') == "6" || $this->session->userdata('role_id') == "1" ){
            $this->preload();
            $this->template_admin->display('dashboard',$this->data);  
        }else{
            $this->preload_staff();
            $this->template_admin->display('dashboard_staff',$this->data);  
        }
           
    }
	
	function logged_in() {
        if (!($this->session->userdata('logged_in'))) {
            redirect(base_url() . "auth");
        }
    }

    public function get_chart_summary(){
        $data = $this->m_dashboard->get_chart_summary();
        echo json_encode($data);
    }

    public function get_chart_summary_approve(){
        $data = $this->m_dashboard->get_chart_summary_approve();
        echo json_encode($data);
    }

    public function get_chart_line(){
         $data = $this->m_dashboard->get_chart_line();
        echo json_encode($data);
    }

}

?>