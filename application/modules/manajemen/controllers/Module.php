<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of module class
 *
 * @author Yogi "solop" Kaputra
 */

class Module extends SLP_Controller
{
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_module' => 'mmod'));
        $this->_vwName  = 'module';
        $this->_uriName = 'manajemen/module';
    }

    private function validasiDataValue($flag = 1)
    {
        if ($flag == 1) {
            $this->form_validation->set_rules('nama_module', 'Nama Module', 'required|trim');
            $this->form_validation->set_rules('label_module', 'Label Module', 'required|trim');
            $this->form_validation->set_rules('url_module', 'URL Module', 'required|trim');
            $this->form_validation->set_rules('status', 'Status', 'required|trim');
        } else {
            $this->form_validation->set_rules('nama_kontrol', 'Nama Kontrol', 'required|trim');
            $this->form_validation->set_rules('nama_fungsi[]', 'Nama Fungsi', 'required|trim');
            $this->form_validation->set_rules('status_rules', 'Status', 'required|trim');
        }
        validation_message_setting();
        if ($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index()
    {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Module', site_url($this->_uriName));
        $this->session_info['page_name']     = 'Manajemen Module';
        $this->session_info['siteUri']      = $this->_uriName;
        $this->session_info['page_js']         = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['data_kontrol']    = $this->mmod->getDataKontrolAll();
        $this->session_info['data_fungsi']    = $this->mmod->getDataFungsiAll();
        $this->template->build($this->_vwName . '/vpage', $this->session_info);
    }

    public function listview()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if (isset($session)) {
                $dataList = $this->mmod->get_datatables();
                $no = $this->input->post('start');
                foreach ($dataList as $key => $dl) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $dl['label_module'];
                    $row[] = $dl['nama_module'];
                    $row[] = $dl['url_module'];
                    $row[] = $dl['deskripsi_module'];
                    $row[] = convert_status($dl['id_status']);
                    $row[] = '<button type="button" class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="' . $this->encryption->encrypt($dl['id_module']) . '" title="Edit data"><i class="fas fa-pencil-alt"></i></button>
                              <button type="button" class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="' . $this->encryption->encrypt($dl['id_module']) . '" title="Hapus data"><i class="fas fa-trash-alt"></i></button>
                              <button type="button" class="btn btn-green btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnRules" data-id="' . $this->encryption->encrypt($dl['id_module']) . '" title="Hapus data"><i class="fas fa-key"></i></button>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->mmod->count_all(),
                    "recordsFiltered" => $this->mmod->count_filtered(),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function create()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if (!empty($session)) {
                if ($this->validasiDataValue(1) == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mmod->insertDataModule();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data module baru dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data module baru dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data module baru gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function details()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $modId    = $this->input->post('token', TRUE);
            if (!empty($modId) and !empty($session)) {
                $data = $this->mmod->getDataDetailModule($this->encryption->decrypt($modId));
                $row = array();
                $row['label']    = !empty($data) ? $data['label_module'] : '';
                $row['nama']    = !empty($data) ? $data['nama_module'] : '';
                $row['url']        = !empty($data) ? $data['url_module'] : '';
                $row['ket']        = !empty($data) ? $data['deskripsi_module'] : '';
                $row['status']    = !empty($data) ? $data['id_status'] : 1;
                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $modId    = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($modId)) {
                if ($this->validasiDataValue(1) == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->mmod->updateDataModule();
                    if ($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data module gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'ERRDATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data module dengan nama ' . $data['nama'] . ' gagal, karena ditemukan nama yang sama'), 'csrfHash' => $csrfHash);
                    } else if ($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data module dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data module gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session   = $this->app_loader->current_account();
            $csrfHash  = $this->security->get_csrf_hash();
            $modId     = escape($this->input->post('tokenId', TRUE));
            if (!empty($session) and !empty($modId)) {
                $data = $this->mmod->deleteDataModule();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data module gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'ERRDATA') {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data module dengan nama ' . $data['nama'] . ' gagal, karena data sedang digunakan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data module dengan nama ' . $data['nama'] . ' sukses', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 0, 'message' => 'Proses delete data module gagal, mohon coba kembali', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function rules($name = null)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($name == 'new-rules')
                $this->rulesCreate();
            else if ($name == 'set-rules')
                $this->rulesUpdate();
            else
                $this->rulesData();
        }
    }

    private function rulesData()
    {
        $session  = $this->app_loader->current_account();
        $csrfHash = $this->security->get_csrf_hash();
        $moduleId = $this->encryption->decrypt(escape($this->input->get('token', TRUE)));
        if (!empty($moduleId) and !empty($session)) {
            $data = $this->mmod->getDataRulesModule($moduleId);
            $rules = array();
            foreach ($data as $q) {
                $isi['id_rules']         = $this->encryption->encrypt($q['id_rules']);
                $isi['nama_fungsi']     = $q['nama_fungsi'];
                $isi['label_fungsi']     = $q['label_fungsi'];
                $isi['status']             = convert_status($q['id_status']);
                $rules[$q['label_kontrol']][] = $isi;
            }
            $result = array('status' => 'RC200', 'message' => $rules, 'csrfHash' => $csrfHash);
        } else {
            $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    private function rulesCreate()
    {
        $session  = $this->app_loader->current_account();
        $csrfHash = $this->security->get_csrf_hash();
        $modId    = escape($this->input->post('tokenRules', TRUE));
        if (!empty($session) and !empty($modId)) {
            if ($this->validasiDataValue(2) == FALSE) {
                $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'kode' => $modId, 'csrfHash' => $csrfHash);
            } else {
                $data = $this->mmod->insertDataModuleRules();
                if ($data['response'] == 'ERROR') {
                    $result = array('status' => 'RC404', 'message' => 'Proses insert data rules gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
                } else if ($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses insert data rules dari module ' . $data['nama'] . ' sukses', 'kode' => $modId, 'csrfHash' => $csrfHash);
                }
            }
        } else {
            $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data rules gagal, mohon coba kembali'), 'kode' => $modId, 'csrfHash' => $csrfHash);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    private function rulesUpdate()
    {
        $session  = $this->app_loader->current_account();
        $csrfHash = $this->security->get_csrf_hash();
        $modId    = escape($this->input->post('tokenId', TRUE));
        $flag     = $this->encryption->decrypt(escape($this->input->post('flag', TRUE)));
        if (!empty($session) and !empty($modId)) {
            $data = $this->mmod->updateDataModuleRules();
            if ($data['response'] == 'ERROR') {
                $result = array('status' => 'RC404', 'message' => 'Proses ' . (($flag == 'DR') ? 'hapus' : 'update status') . ' data rules gagal, karena data tidak ditemukan', 'csrfHash' => $csrfHash);
            } else if ($data['response'] == 'SUCCESS') {
                $result = array('status' => 'RC200', 'message' => 'Proses ' . (($flag == 'DR') ? 'hapus' : 'update status') . ' data rules dari module ' . $data['nama'] . ' sukses', 'kode' => $modId, 'csrfHash' => $csrfHash);
            }
        } else {
            $result = array('status' => 'RC404', 'message' => 'Proses ' . (($flag == 'DR') ? 'hapus' : 'update status') . ' data rules gagal, mohon coba kembali', 'kode' => $modId, 'csrfHash' => $csrfHash);
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }
}

// This is the end of fungsi class
