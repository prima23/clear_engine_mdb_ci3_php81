<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of fungsi class
 *
 * @author Yogi "solop" Kaputra
 */

class Fungsi extends SLP_Controller {
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct() {
        parent::__construct();
        $this->load->model(array('model_fungsi' => 'mfunc'));
        $this->_vwName = 'fungsi';
        $this->_uriName = 'manajemen/fungsi';
    }

    private function validasiDataValue() {
        $this->form_validation->set_rules('nama_fungsi', 'Nama Fungsi', 'required|trim');
        $this->form_validation->set_rules('label_fungsi', 'Label Fungsi', 'required|trim');
        $this->form_validation->set_rules('url_fungsi', 'URL Fungsi', 'required|trim');
        $this->form_validation->set_rules('jenis_fungsi', 'Jenis Fungsi', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        validation_message_setting();
        if($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index() {
        $this->breadcrumb->add('Home', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Fungsi', site_url($this->_uriName));
        $this->session_info['page_name'] 	= 'Manajemen Fungsi';
        $this->session_info['siteUri']      = $this->_uriName;
        $this->session_info['page_js']	 	= $this->load->view($this->_vwName.'/vjs', array('siteUri'=>$this->_uriName), true);
        $this->session_info['jenis_fungsi']	= $this->mfunc->getDataJenisFungsi();
        $this->template->build($this->_vwName.'/vpage', $this->session_info);
    }

    public function listview() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if(isset($session)){
                $dataList = $this->mfunc->get_datatables();
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $dl['label_fungsi'];
                    $row[] = $dl['nama_fungsi'];
                    $row[] = $dl['url_fungsi'];
                    $row[] = '<span class="badge badge-pill badge-default">'.$dl['jenis_fungsi'].'</span>';
                    $row[] = $dl['deskripsi_fungsi'];
                    $row[] = convert_status($dl['id_status']);
                    $row[] = '<button type="button" class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($dl['id_fungsi']).'" title="Edit data"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($dl['id_fungsi']).'" title="Hapus data"><i class="fas fa-trash-alt"></i></button>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mfunc->count_all(),
                    "recordsFiltered" => $this->mfunc->count_filtered(),
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
                    $data = $this->mfunc->insertDataFungsi();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data fungsi baru dengan nama '.$data['nama'].' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data fungsi baru dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data fungsi baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
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
            $funcId   = $this->input->post('token', TRUE);
            if(!empty($funcId) AND !empty($session)) {
                $data = $this->mfunc->getDataDetailFungsi($this->encryption->decrypt($funcId));
                $row = array();
                $row['label']	= !empty($data) ? $data['label_fungsi'] : '';
                $row['nama']	= !empty($data) ? $data['nama_fungsi'] : '';
                $row['url']	    = !empty($data) ? $data['url_fungsi'] : '';
                $row['ket']	    = !empty($data) ? $data['deskripsi_fungsi'] : '';
                $row['jenis']	= !empty($data) ? $data['id_jenis_fungsi'] : '';
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
            $funcId   = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($funcId)) {
                if($this->validasiDataValue() == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mfunc->updateDataFungsi();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data fungsi gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data fungsi dengan nama '.$data['nama'].' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data fungsi dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data fungsi gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete() {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $funcId   = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($funcId)) {
                $data = $this->mfunc->deleteDataFungsi();
                if($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data fungsi gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data fungsi dengan nama '.$data['nama'].' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data fungsi dengan nama '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data fungsi gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of fungsi class
