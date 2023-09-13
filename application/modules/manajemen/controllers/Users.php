<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users class
 *
 * @author Yogi "solop" Kaputra
 */

class Users extends SLP_Controller {
    protected $_vwName   = '';
    protected $_uriName  = '';
    protected $_unitId   = '';
    public function __construct() {
        parent::__construct();
        $this->load->model(array('model_users' => 'muser', 'master/model_master' => 'mmas'));
        $this->_vwName  = 'user';
        $this->_uriName = 'manajemen/users';
        //set data daerah
        $dataUser = currentDataUser();
        $this->_unitId = !empty($dataUser) ? $dataUser['unit_id'] : '';
    }

    private function validasiDataValue($role) {
        if($role == 'new') {
            $valid = 'required|';
        } else {
            $valid = ($this->input->post('password') != '') ? 'required|' : '';
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|alpha_dash');
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', $valid.'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$#!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/]');
        $this->form_validation->set_rules('conf_password', 'Konfirmasi Password', $valid.'matches[password]');
        $this->form_validation->set_rules('groupid[]', 'Group User', 'required|trim');
        validation_message_setting();
        if ($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function index() {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Manajemen', '#');
        $this->breadcrumb->add('Users', site_url($this->_uriName));

        $this->session_info['page_name']   = 'Manajamen User';
        $this->session_info['siteUri']     = $this->_uriName;
        $this->session_info['page_js']	   = $this->load->view($this->_vwName.'/vjs', array('siteUri'=>$this->_uriName), true);
        $this->session_info['data_level']  = $this->muser->getDataLevelAkses();
        $this->session_info['data_group']  = $this->muser->getDataListGroup();
        $this->session_info['group_user']  = $this->muser->getDataGroup();
        $this->session_info['data_opd']    = "";
        $this->session_info['data_opd_operator']    = $this->encryption->encrypt('3');
        $this->template->build($this->_vwName.'/vpage', $this->session_info);
    }

    public function getOptionOpd(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = $this->muser->getOptionOpd();
            if(is_null($data)){
                $csrfHash = $this->security->get_csrf_hash();
                $result = array('status' => 'RC404', 'dataOption' => $data, 'csrfHash' => $csrfHash);
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            }else{
                $csrfHash = $this->security->get_csrf_hash();
                $result = array('status' => 'RC200', 'dataOption' => $data, 'csrfHash' => $csrfHash);
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            }
        }
    }

    public function listview() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data = array();
            $session = $this->app_loader->current_account();
            if(isset($session)) {
                $param    = $this->input->post('param',TRUE);
                $dataUser = $this->muser->get_datatables($param, $this->_unitId);
                $no       = $this->input->post('start');
                foreach ($dataUser as $key => $u) {
                    $no++;
                    $row = array();
                    $arrGroup = explode(',', $u['group_user']);
                    $nm_group = '<ul style="margin-left:-30px;">';
                    foreach ($arrGroup as $g) {
                        $nm_group .= '<li>'.$g.'</li>';
                    }
                    $nm_group .= '</ul>';
                    $password = ($this->app_loader->is_super()) ? '<li><strong>Password :</strong> '.$u['pass_plain'].'</li>' : '';
                    $row[] = '<div class="custom-control custom-checkbox mt-0 pt-0">
                                <input type="checkbox" class="custom-control-input" name="checkid[]" id="u_'.$u['token'].'" value="'.$u['token'].'">
                                <label class="custom-control-label font-weight-bolder" for="u_'.$u['token'].'"></label>
                             </div>';
                    $row[] = $no;
                    $row[] = '<ul class="list-unstyled" style="margin-bottom:0px;">'.
                                '<li><strong>Username :</strong> '.$u['username'].'</li>'.
                                $password.
                                '<li><strong>Nama :</strong> '.$u['fullname'].'</li>'.
                              '</ul>';
                    $row[] = $nm_group;
                    $row[] = ($u['unit_id_name']) ? $u['unit_id_name'] : "-";
                    $row[] = convert_blokir($u['blokir']);
                    $row[] = convert_status($u['id_status']);
                    $row[] = '<button type="button" class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$u['token'].'" title="Edit data user"><i class="fas fa-pencil-alt"></i> </button>';
                    $data[] = $row;
                }
                $output = array(
                    "draw" => $this->input->post('draw'),
                    "recordsTotal" => $this->muser->count_all($this->_unitId),
                    "recordsFiltered" => $this->muser->count_filtered($param, $this->_unitId),
                    "data" => $data,
                );
            }
            //output to json format
            $this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function create() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $result = "";
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            if(!empty($session)) {
                if($this->validasiDataValue('new') == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->muser->insertDataUsers();
                    if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data user baru dengan username '.$data['name'].' gagal, karena sudah ada user yang menggunakan username yang sama'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses insert data user baru dengan username '.$data['name'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses insert data user gagal, mohon coba kembali'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function details() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token    = escape($this->input->post('tokenId', TRUE));
            if(!empty($token) AND !empty($session)) {
                $data = $this->muser->getDataDetailUsers($token, $this->_unitId);
                $row = array();
                $row['fullname'] = !empty($data) ? $data['fullname'] : '';
                $row['username'] = !empty($data) ? $data['username'] : '';
                $row['blokir']	 = !empty($data) ? $data['blokir'] : 0;
                $row['status']	 = !empty($data) ? $data['id_status'] : 1;
                $row['unit_id']	 = !empty($data) ? $data['unit_id'] : 1;
                $row['groupid']	 = !empty($data) ? explode(',', str_replace(' ', '', $data['group_user'])) : array();
                $result = array('status' => 'RC200', 'message' => $row, 'csrfHash' => $csrfHash);
            } else {
                $result = array('status' => 'RC404', 'message' => array(), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function update() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $token 		= escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($token)) {
                if($this->validasiDataValue('edit') == FALSE) {
                    $result = array('status' => 'RC404', 'message' => $this->form_validation->error_array(), 'csrfHash' => $csrfHash);
                } else {
                    $data = $this->muser->updateDataUsers($this->_unitId);
                    if($data['response'] == 'NODATA') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data user dengan username '.$data['nama'].' gagal, karena data tidak ditemukan'), 'csrfHash' => $csrfHash);
                    }	else if($data['response'] == 'ERROR') {
                        $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data user dengan username '.$data['nama'].' gagal, karena sudah ada user yang menggunakan username yang sama'), 'csrfHash' => $csrfHash);
                    } else if($data['response'] == 'SUCCESS') {
                        $result = array('status' => 'RC200', 'message' => 'Proses update data user dengan username '.$data['nama'].' sukses', 'csrfHash' => $csrfHash);
                    }
                }
            } else {
                $result = array('status' => 'RC404', 'message' => array('isi' => 'Proses update data user gagal, mohon coba kembali...'), 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function delete() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session   = $this->app_loader->current_account();
            $csrfHash  = $this->security->get_csrf_hash();
            $token     = escape($this->input->post('tokenId', TRUE));
            if(!empty($session) AND !empty($token)) {
                $data = $this->muser->deleteDataUsers($this->_unitId);
                if($data['response'] == 'SUCCESS') {
                    $result = array('status' => 'RC200', 'message' => 'Proses delete data user sukses', 'csrfHash' => $csrfHash);
                } else {
                    $result = array('status' => 'RC404', 'message' => 'Proses delete data user gagal, silahkan periksa kembali', 'csrfHash' => $csrfHash);
                }
            } else {
                $result = array('status' => 'RC404', 'message' => 'Proses delete data user gagal', 'csrfHash' => $csrfHash);
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }

    public function searching() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $session  = $this->app_loader->current_account();
            $csrfHash = $this->security->get_csrf_hash();
            $username = escape($this->input->get('username', TRUE));
            if(!empty($session) AND !empty($username)) {
                $data  = $this->muser->searchDataUsername($username);
                $result = array('message' => $data, 'csrfHash' => $csrfHash);
            } else
                $result = array('message' => 0, 'csrfHash' => $csrfHash);
            $this->output->set_content_type('application/json')->set_output(json_encode($result));
        }
    }
}

// This is the end of users class
