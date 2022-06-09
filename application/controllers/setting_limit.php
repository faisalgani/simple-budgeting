<?php

class Setting_limit extends CI_Controller {

    public $data;
    public $filter;
    public $limit = 10;

    public function __construct() {
        parent::__construct();
        define('CURRENT_CONTEXT', base_url() . 'setting_limit/');
        $this->data = array();
        init_generic_dao();
        $this->load->model(array('m_setting_limit'));
        $this->load->library(array('template_admin'));
        $this->logged_in();
        $this->data['page_title'] = "Setting Limit";
    }

    private function validate() {
        $this->form_validation->set_rules('jml_limit', 'Jumlah Limit ', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('created_at', 'Created At', 'trim');
        $this->form_validation->set_rules('updated_at', 'Updated At', 'trim');

        return $this->form_validation->run();
    }

    /**
      prepare data for view
     */
    public function preload() {
        $this->data['current_context'] = CURRENT_CONTEXT;
    }

    public function index($page = 1) {
        $this->preload();
        $offset = ($page - 1) * $this->limit;
        $this->data['offset'] = $offset;
        $this->get_list($this->limit, $offset);
    }

    public function fetch_record($keys) {
        $this->data['setting_limit'] = $this->m_setting_limit->by_id($keys);
    }

    private function fetch_data($limit, $offset, $key) {
        $this->data['setting_limit'] = $this->m_setting_limit->fetch($limit, $offset, null, true, null, null, $key);
        $this->data['total_rows'] = $this->m_setting_limit->fetch(null, null, null, true, null, null, $key, true);
    }

    private function fetch_input() {
        $data = array('jml_limit' => $this->input->post('jml_limit'));
        return $data;
    }

    public function add() {
        $obj = $this->fetch_input();
        $obj['created_by'] = $this->session->userdata('username');
        $obj['created_at'] = date('Y-m-d H:i:s');

        if ($this->validate() != false) {
            $this->m_setting_limit->insert($obj);
            redirect(CURRENT_CONTEXT);
        } else {
            $this->preload();
            $this->data['edit'] = false;
            #set value
            $this->data['setting_limit'] = (object) $obj;
            $this->template_admin->display('setting_limit/setting_limit_insert', $this->data);
        }
    }
    /**

      @description
      viewing editing form. repopulation for every data needed in form done here.
     */
    public function edit($id) {
        $obj = $this->fetch_input();
        $obj['updated_by'] = $this->session->userdata('username');
        $obj['updated_at'] = date('Y-m-d H:i:s');

        $obj_id = array('id' => $id);
        if ($this->validate() != false) {
            $this->m_setting_limit->update($obj, $obj_id);
            redirect(CURRENT_CONTEXT);
        } else {
            $this->preload();
            $this->data['edit'] = true;
            $this->fetch_record($obj_id);
            $this->template_admin->display('setting_limit/setting_limit_insert', $this->data);
        }
    }

    /**
      @description
      viewing record. repopulation for every data needed for view.
     */
    public function detail($id) {
        $obj_id = array('id' => $id);
        $this->preload();
        $this->fetch_record($obj_id);
        $this->template_admin->display('setting_limit/setting_limit_detail', $this->data);
    }


    public function delete($id) {
        $obj_id = $id;
        $obj = array('updated_by' => $this->session->userdata('username'), 'updated_at' => date('Y-m-d H:i:s'),'is_deleted' => 1);
        $this->m_setting_limit->delete_data($obj_id);
        $this->session->set_flashdata(array('message' => 'Data berhasil dihapus.', 'type_message' => 'success'));
        redirect(CURRENT_CONTEXT);
    }


    public function get_list($limit = 10, $offset = 0, $key = null) {
        #generate pagination
        $this->fetch_data($limit, $offset, $key);
        $config['base_url'] = CURRENT_CONTEXT . ((!empty($key)) ? 'search' : 'index');
        $config['total_rows'] = $this->data['total_rows'];
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->template_admin->display('setting_limit/setting_limit_list', $this->data);
    }

    function logged_in() {
        if (!($this->session->userdata('logged_in'))) {
            redirect(base_url() . "auth");
        }
    }

}

?>