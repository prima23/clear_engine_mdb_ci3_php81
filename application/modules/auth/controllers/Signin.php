<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of login class
 *
 * @author Yogi "solop" Kaputra
 */

class Signin extends MY_Controller {
    protected $username		= "";
    protected $password 	= "";
    protected $ip_address   = "";
    protected $user_agent   = "";
    public function __construct() {
        parent::__construct();
        
        $this->load->model(array('model_auth_signin' => 'mas'));
        $this->username 	= escape(trim($this->input->post('username', TRUE) ?? ""));
        $this->password 	= escape($this->input->post('password', TRUE));
        $this->ip_address   = addslashes($this->input->ip_address());
        $this->user_agent   = addslashes($this->input->user_agent());
    }

    private function validationValueCheck($role) {
        if($role == 1) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
        } else {
            $this->form_validation->set_rules('groupid', 'Group', 'required|trim');
        }
        validation_message_setting();
        if ($this->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public function login() {
        $flag = escape($this->encryption->decrypt($this->input->post('authorization', TRUE)));
        if($flag == 'login')
            $this->prosesLoginForm();
        else if($flag == 'group')
            $this->prosesSelectGroupForm();
        else
            $this->createLoginForm();
    }

    public function account() {
        $sessid = $this->input->get('authtoken', TRUE);
        $time   = $this->input->get('time', TRUE);
        $ip     = $this->input->get('ipaddress', TRUE);
        $user   = $this->input->get('user', TRUE);
        //cek url
        
        $data = $this->mas->cekSessionLogUser($user, $sessid, $ip, $time, $this->user_agent);
        if($data > 0){
            redirect('home');
        }
        else{
            redirect('auth/signin/logout');
        }
    }

    private function createLoginForm() {
        $setApps = setApps();
        $data['appName']   = !empty($setApps) ? $setApps['app_name'] : '';
        $data['appAuthor'] = !empty($setApps) ? $setApps['app_author'] : '';
        $data['appDescs']  = !empty($setApps) ? $setApps['app_description'] : '';
        $data['appKeys']   = !empty($setApps) ? $setApps['app_keywords'] : '';
        $data['appIcon']   = !empty($setApps) ? $setApps['app_icon'] : '';
        $data['appFavico'] = !empty($setApps) ? $setApps['app_favicon'] : '';
        $data['appYear']   = !empty($setApps) ? $setApps['app_year'] : '';
        $this->load->view('formLogin', $data);
    }

    private function prosesLoginForm() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $csrfHash   = $this->security->get_csrf_hash();
            $total      = $this->session->userdata('error_session');
            if($this->validationValueCheck(1) == FALSE) {
                $result = array('status' => 0, 'message' => $this->form_validation->error_array(), 'flag' => 1, 'csrfHash' => $csrfHash);
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            } else {
                
                //cek username yang diinputkan pertama
                $checkUser = $this->is_username($this->username);
                if(empty($checkUser) OR count($checkUser) <= 0) {
                    //insert error ke dalam session
                    $this->set_error_session();
                    $result = array('status' => 0, 'message' => array('isi' => 'Username tidak ditemukan'), 'flag' => 1, 'csrfHash' => $csrfHash);
                    $this->output->set_content_type('application/json')->set_output(json_encode($result));
                } else {
                    //cek username dan password
                    if($this->is_password($this->username, $this->password) === FALSE) {
                        //insert error log ke table log login
                        $this->mas->setLoginFailed($this->username, $this->ip_address, $this->user_agent);
                        $blockir = $this->cek_blockir($this->username);
                        if($blockir >= 3 && $blockir < 10) {
                            $result = array('status' => 0, 'message' => array('isi' => 'Anda sudah '.$blockir.' kali salah menginputkan password, batas kesalahan 10 kali. Jika masih salah akun anda akan diblokir otomatis oleh sistem...'), 'flag' => 1, 'csrfHash' => $csrfHash);
                            $this->output->set_content_type('application/json')->set_output(json_encode($result));
                        } else if($blockir >= 10) {
                            $this->mas->setAccountUserBlock($this->username);
                            $result = array('status' => 0, 'message' => array('isi' => 'Akun anda telah diblokir oleh sistem, silahkan hubungi admin...'), 'flag' => 1, 'csrfHash' => $csrfHash);
                            $this->output->set_content_type('application/json')->set_output(json_encode($result));
                        } else {
                            $result = array('status' => 0, 'message' => array('isi' => 'Username dan Password anda tidak cocok'), 'flag' => 1, 'csrfHash' => $csrfHash);
                            $this->output->set_content_type('application/json')->set_output(json_encode($result));
                        }
                        //insert error ke dalam session
                        $this->set_error_session();
                    } else {
                        //cek akun aktif atau tidak
                        if($this->is_actived($this->username) === FALSE) {
                            $result = array('status' => 0, 'message' => array('isi' => 'Akun anda sudah tidak aktif lagi, silahkan hubungi admin'), 'flag' => 1, 'csrfHash' => $csrfHash);
                            $this->output->set_content_type('application/json')->set_output(json_encode($result));
                        } else {
                            //cek akun blokir atau tidak
                            if($this->is_blockir($this->username) === TRUE) {
                                $result = array('status' => 0, 'message' => array('isi' => 'Akun anda saat ini sedang diblokir, silahkan hubungi admin'), 'flag' => 1, 'csrfHash' => $csrfHash);
                                $this->output->set_content_type('application/json')->set_output(json_encode($result));
                            } else {
                                //set session username
                                
                                $this->session->set_userdata('account_name', $this->username);
                                //delete failed log
                                $this->mas->deleteFailedLog($this->username);
                                //ambil group user
                                $getGroup = $this->mas->getDataUserGroup($this->username);

                                if(count($getGroup) > 1) {
                                    //multi group
                                    $fullname   = !empty($checkUser) ? $checkUser['fullname'] : '';
                                    $avatar 	= !empty($checkUser) ? $checkUser['foto_profile'] : '';
                                    $result     = array('status' => 2, 'message' => $this->load->view('formGroup', array('multi_group' => $getGroup, 'fullname' => $fullname, 'username' => $this->username, 'foto' => $avatar), TRUE), 'flag' => 2, 'csrfHash' => $csrfHash);
                                    $this->output->set_content_type('application/json')->set_output(json_encode($result));
                                } else if(count($getGroup) == 1) {
                                    //insert success login
                                    
                                    $dataLog = $this->mas->setSuccessLog($this->username, $this->ip_address, $this->user_agent);
                                    //set login time
                                    $this->expired_login->login_time();
                                    //set session satu group
                                    $this->set_session($this->username, $getGroup[0]['id_group']);
                                    $result = array('status' => 1, 'message' => array('url' => site_url('auth/signin/account?'.$dataLog)), 'flag' => 1, 'csrfHash' => $csrfHash, 'session' => $this->session);

                                    $this->output->set_content_type('application/json')->set_output(json_encode($result));
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    private function prosesSelectGroupForm() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $csrfHash   = $this->security->get_csrf_hash();
            $username   = $this->session->userdata('account_name');
            $group 	    = $this->encryption->decrypt($this->input->post('groupid', TRUE));
            if($this->validationValueCheck(2) == FALSE) {
                $result = array('status' => 0, 'message' => array('isi' => 'Anda harus pilih salah satu group untuk bisa login'), 'flag' => 2, 'csrfHash' => $csrfHash);
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            } else {
                //insert success login
                $dataLog = $this->mas->setSuccessLog($username, $this->ip_address, $this->user_agent);
                //set login time
                $this->expired_login->login_time();
                //set session user
                $this->set_session($username, $group);
                //set group session
                $this->set_group_session($username);
                $result = array('status' => 1, 'message' => array('url' => site_url('auth/signin/account?'.$dataLog)), 'flag' => 2, 'csrfHash' => $csrfHash);
                $this->output->set_content_type('application/json')->set_output(json_encode($result));
            }
        }
    }

    private function is_username($username) {
        $data = $this->mas->cekDataUsername($username);
        return $data;
    }

    private function is_password($username, $password) {
        $validpass = $this->mas->cekDataUsernamePass($username, $password);
        return $validpass;
    }

    private function is_actived($username) {
        $actived = $this->mas->cekDataUserActive($username);
        return $actived;
    }

    private function is_blockir($username) {
        $blocked = $this->mas->cekDataUserBlock($username);
        return $blocked;
    }

    private function cek_blockir($username) {
        $log = $this->mas->getCountFailedLog($username);
        return $log->num_rows();
    }

    /**
     * Fungsi untuk melakukan hitung error login
     */
    private function set_error_session() {
        $getError = $this->session->userdata('error_session');
        $num = isset($getError) ? $getError : 0;
        $this->session->set_userdata('error_session', $num+1);
    }

    private function set_session($username, $group) {
        //ambil data user berdasarkan group
        $dataUser = $this->mas->getDataUserProperties($username, $group);
        if(count($dataUser) > 0) {
            $session['fullname']  			= $dataUser['fullname'];
            $session['group_active']		= $dataUser['id_group'];
            $session['group_name']			= $dataUser['nama_group'];
            $session['level_akses']			= $dataUser['level_akses'];
            $session['nick_level']			= $dataUser['nick_level'];
            $session['user_id']			    = $dataUser['token'];
            $session['unit_id']			    = $dataUser['unit_id'];
            $session['unit_id_name']		= $dataUser['unit_id_name'];
            //simpan session
            $this->session->set_userdata($session);
        } else
            redirect('auth/signin/logout');
    }

    /**
     * Fungsi untuk melakukan set sesi grup
     * @param array $session_data
     */
    private function set_group_session($username) {
        //set group session
        $dataGroup = $this->mas->getDataUserGroup($username);
        $sess = array();
        foreach ($dataGroup as $key => $v) {
            $data['id_group']       = $v['id_group'];
            $data['nama_group']     = $v['nama_group'];
            $sess['group_switch'][] = $data;
        }
        $this->session->set_userdata($sess);
    }

    public function switch_group($group) {
        $username 	= $this->session->userdata('account_name');
        $session_id = $this->session->userdata('clear3ngine2022');
        $statuslog	= $this->mas->cekSessionLog($username, $this->ip_address, $this->user_agent, $session_id);
        if($statuslog != 0 AND !empty($session_id) AND !empty($username) AND ((!empty($group) OR $group != 0 OR $group != ''))) {
            //set login time
            $this->expired_login->login_time();
            //set session user
            $this->set_session($username, $group);
            //set group session
            $this->set_group_session($username);
            //redirect ke home
            redirect('home');
        } else
            redirect('auth/signin/logout');
    }

    //fungsi untuk menghapus session
    private function destroy_session() {
        $array_session = array(	'account_name', 'nama_user', 'group_active',
                                'group_name', 'group_switch', 'id_level_akses',
                                'level_akses', 'nick_level', 'error_session',
                                'user_id', 'unit_id', 'clear3ngine2022');
        $this->session->unset_userdata($array_session);
    }

    public function logout() {
        $this->session->unset_userdata('expires_by');
        $username  	= $this->session->userdata('account_name');
        $session_id = $this->session->userdata('clear3ngine2022');
        $ip_address = $this->input->ip_address();
        $user_agent = $this->input->user_agent();
        $this->mas->updateDataSessionLog($session_id, $username, $ip_address, $user_agent);
        $this->destroy_session();
        error_message('info', 'Informasi!', 'Anda telah keluar dari aplikasi');
        header('location: '.site_url());
    }

    public function timeout() {
        $this->session->unset_userdata('expires_by');
        $username  	= $this->session->userdata('account_name');
        $session_id = $this->session->userdata('clear3ngine2022');
        $ip_address = $this->input->ip_address();
        $user_agent = $this->input->user_agent();
        $this->mas->updateDataSessionLog($session_id, $username, $ip_address, $user_agent);
        $this->destroy_session();
        error_message('info', 'Informasi!', 'Maaf sesi anda telah habis. Silahkan ulang login untuk masuk ke akun anda');
        header('location: '.site_url());
    }
}

// This is the end of home class
