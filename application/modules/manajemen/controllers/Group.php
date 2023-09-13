<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of group class
 *
 * @author Yogi "solop" Kaputra
 */

class Group extends SLP_Controller {
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct() {
        parent::__construct();
        $this->load->model(array('model_group'=>'mgrp'));
        $this->_vwName  = 'group';
        $this->_uriName = 'manajemen/group';
    }

    public function validasiDataValue() {
        $this->form_validation->set_rules('nama_group', 'Nama Grup', 'required|trim');
        $this->form_validation->set_rules('level_akses', 'Level Akses', 'required|trim');
        validation_message_setting();
        if($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index() {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Group', site_url($this->_uriName));
        $this->session_info['page_name']   = 'Manajamen Group';
        $this->session_info['siteUri']     = $this->_uriName;
        $this->session_info['page_js']	   = $this->load->view($this->_vwName.'/vjs', array('siteUri'=>$this->_uriName), true);
        $this->session_info['level_akses'] = $this->mgrp->getDataLevelAkses();
        $this->template->build($this->_vwName.'/vpage', $this->session_info);
    }

    public function listview() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if(isset($session)){
                $dataList = $this->mgrp->get_datatables();
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $dl['nama_group'];
                    $row[] = '<span class="badge badge-pill badge-default">'.$dl['level_akses'].'</span>';
                    $row[] = ($dl['hak_akses'] != '') ? $dl['hak_akses'] : '<i class="text-danger font-weight-bolder">Hak akses belum disetting</i>';
                    $row[] = convert_status($dl['id_status']);
                    $row[] = '<button type="button" class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($dl['id_group']).'" title="Edit data"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($dl['id_group']).'" title="Hapus data"><i class="fas fa-trash-alt"></i></button>
                              <button type="button" class="btn btn-green btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnPrivilage" data-id="'.$this->encryption->encrypt($dl['id_group']).'" title="Setting Privilege"><i class="fas fa-lock"></i></button>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mgrp->count_all(),
                    "recordsFiltered" => $this->mgrp->count_filtered(),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function create() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if(!empty($session)) {
                if($this->validasiDataValue() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mgrp->insertDataGroup();
                    if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data group baru dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data group baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $groupId  = $this->input->post('token', TRUE);
            if(!empty($groupId) AND !empty($session)) {
                $data = $this->mgrp->getDataDetailGroup($this->encryption->decrypt($groupId));
                $row = array();
                $row['nama']	= !empty($data) ? $data['nama_group'] : '';
                $row['akses']	= !empty($data) ? $data['id_level_akses'] : '';
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
            $groupId  = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($groupId)) {
                if($this->validasiDataValue() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mgrp->updateDataGroup();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data group gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data group dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data group gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $groupId   = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($groupId)) {
                $data = $this->mgrp->deleteDataGroup();
                if($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data group gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data group dengan nama '.$data['nama'].' gagal, data tidak boleh dihapus karena sedang digunakan', 'csrfHash' => $csrfHash);
                } else if($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data group dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data group gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function privileges($name=null) {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($name == 'save-access')
                $this->privilegesCreate();
            else
                $this->privilegesData();
        }
    }

    private function privilegesData() {
        $session  = $this->app_loader->current_account();
        $csrfHash = $this->security->get_csrf_hash();
        $groupId  = $this->encryption->decrypt(escape($this->input->get('token', TRUE)));
        if(!empty($groupId) AND !empty($session)) {
            $dataPrivilage = $this->mgrp->getDataRulesGroupPrivileges($groupId);
            $access = array();
            foreach ($dataPrivilage as $key => $p) {
                $access[] = $p['id_rules'];
            }
            $rules = array();
            $dataRules = $this->mgrp->getDataAllRulesModule();
            foreach ($dataRules as $row => $r) {
                $item['id_rules']       = $this->encryption->encrypt($r['id_rules']);
                $item['title_fungsi']   = $r['label_fungsi'];
                $item['checked']        = in_array($r['id_rules'], $access) ? 'checked="checked"' : '';
                $rules[$r['label_module']][$r['label_kontrol']][] = $item;
            }
            $result = array('status' => 'RC200', 'message' => $rules, 'csrfHash' => $csrfHash);
        } else {
            $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    private function privilegesCreate() {
        $session  = $this->app_loader->current_account();
        $csrfHash = $this->security->get_csrf_hash();
        $groupId  = escape($this->input->post('tokenId', TRUE));
        if(!empty($session) AND !empty($groupId)) {
            $data = $this->mgrp->insertDataGroupPrivilege();
            if($data['response'] == 'ERROR') {
                $result = array('status' => 'RC404', 'message' => 'Proses simpan data group privilege gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
            } else if($data['response'] == 'SUCCESS') {
                $result = array('status' => 'RC200', 'message' => 'Proses simpan data group privilege '.$data['nama'].' sukses', 'kode'=>$groupId, 'csrfHash' => $csrfHash);
            }
        } else {
            $result = array('status' => 'RC404', 'message' => 'Proses simpan data group privilege gagal, mohon coba kembali', 'kode'=>$groupId, 'csrfHash' => $csrfHash);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}

// This is the end of fungsi class
