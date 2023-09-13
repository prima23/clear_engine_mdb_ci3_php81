<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of menu class
 *
 * @author Yogi "solop" Kaputra
 */

class Menu extends SLP_Controller {
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct() {
        parent::__construct();
        $this->load->model(array('model_menu' => 'mmenu'));
        $this->_vwName  = 'menu';
        $this->_uriName = 'manajemen/menu';
    }

    public function validasiDataValue($type) {
        $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required|trim');
        $this->form_validation->set_rules('is_parent', 'Type Menu', 'required|trim');
        $this->form_validation->set_rules('order_menu', 'Order Menu', 'required|numeric|trim');
        if($type == 'N')
            $this->form_validation->set_rules('nama_rules', 'Module', 'required|trim');
        validation_message_setting();
        if($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index() {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Menu', site_url($this->_uriName));
        $this->session_info['page_name'] = 'Manajemen Menu';
        $this->session_info['siteUri']   = $this->_uriName;
        $this->session_info['page_js']	 = $this->load->view($this->_vwName.'/vjs', array('siteUri'=>$this->_uriName), true);
        $this->session_info['parent']	 = $this->mmenu->getDataParentMenu();
        $this->session_info['rules'] 	 = $this->mmenu->getDataRulesModule();
        $this->template->build($this->_vwName.'/vpage', $this->session_info);
    }

    public function listview() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if(!empty($session)) {
                $data = $this->mmenu->getDataListMenu();
                $result = array('status' => (($data != '') ? 'RC200' : 'RC404'), 'message' => $data, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => '', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function create() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $type     = escape($this->input->post('is_parent', TRUE));
            if(!empty($session)) {
                if($this->validasiDataValue($type) == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mmenu->insertDataMenu();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data menu baru dengan nama '.$data['nama'].' gagal, karena nomor urut '.$data['order'].' sudah digunakan oleh menu lain'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data menu baru dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data menu baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function details() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $menuId   = $this->input->post('token', TRUE);
            if(!empty($menuId) AND !empty($session)) {
                $data = $this->mmenu->getDataDetailMenu($this->encryption->decrypt($menuId));
                $row = array();
                $row['title']	= !empty($data) ? $data['title_menu'] : '';
                $row['parent']	= !empty($data) ? (($data['parent_id'] != 0) ? $data['parent_id'] : '') : '';
                $row['type']    = !empty($data) ? $data['is_parent'] : '';
                $row['rules']   = !empty($data) ? $this->encryption->encrypt($data['id_rules']) : $this->encryption->encrypt(0);
                $row['access']  = !empty($data) ? $data['url_module'].'/'.$data['url_kontrol'].'/'.$data['url_fungsi'] : '';
                $row['url']     = !empty($data) ? $data['url_menu'] : '';
                $row['order']   = !empty($data) ? $data['order_menu'] : '';
                $row['icon']    = !empty($data) ? $data['icon_menu'] : '';
                $row['status']	= !empty($data) ? $data['id_status'] : 1;
                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function update() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $menuId   = escape($this->input->post('tokenId', TRUE));
            $type     = escape($this->input->post('is_parent', TRUE));
            if(!empty($session) AND !empty($menuId)) {
                if($this->validasiDataValue($type) == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mmenu->updateDataMenu();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data menu gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'HAVENO') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data menu dengan nama '.$data['nama'].' gagal, karena nomor urut '.$data['order'].' sudah digunakan oleh menu lain'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data menu dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data menu gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session   = $this->app_loader->current_account();
            $csrfHash  = $this->security->get_csrf_hash();
            $menuId    = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($menuId)) {
                $data = $this->mmenu->deleteDataMenu();
                if($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data menu gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data menu dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data menu gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of fungsi class
