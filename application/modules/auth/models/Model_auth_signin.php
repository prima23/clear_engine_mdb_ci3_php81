<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of auth signin model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_auth_signin extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function cekDataUsername($username) {
        $this->db->where('username', escape($username));
        $this->db->order_by('id_users', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('xi_sa_users');
        return $query->row_array();
    }

    public function cekDataUsernamePass($username, $password) {
        $getUser = $this->cekDataUsername($username);
        $hash_password = !empty($getUser) ? $getUser['password'] : "";
        if ($this->bcrypt->check_password($password, $hash_password))
            return TRUE;
        else
            return FALSE;
    }

    public function cekDataUserActive($username) {
        $getUser = $this->cekDataUsername($username);
        $active = !empty($getUser) ? $getUser['id_status'] : 0;
        if ($active == 1)
            return TRUE;
        else
            return FALSE;
    }

    public function cekDataUserBlock($username) {
        $getUser = $this->cekDataUsername($username);
        $blokir = !empty($getUser) ? $getUser['blokir'] : 0;
        if ($blokir != 0)
            return TRUE;
        else
            return FALSE;
    }

    public function getDataUserGroup($username) {
        $this->db->select('g.id_group,
						   g.nama_group,
						   g.id_level_akses');
        $this->db->from('xi_sa_group g');
        $this->db->join('xi_sa_users_privileges up', 'g.id_group = up.id_group', 'inner');
        $this->db->join('xi_sa_users u', 'up.id_users = u.id_users', 'inner');
        $this->db->where('g.id_status', 1);
        $this->db->where('up.id_status', 1);
        $this->db->where('u.username', escape($username));
        $this->db->where('u.id_status', 1);
        $this->db->where('u.blokir', 0);
        $this->db->order_by('g.id_group', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataUserProperties($username, $group) {
        $this->db->select('u.id_users,
                           u.token,
                           u.username,
                           u.email,
                           u.fullname,
                           u.foto_profile,
                           up.id_group,
                           g.nama_group,
                           g.id_level_akses,
                           la.level_akses,
                           la.nick_level,
                           u.unit_id,
                           u.unit_id_name');
        $this->db->from('xi_sa_users u');
        $this->db->join('xi_sa_users_privileges up', 'u.id_users = up.id_users', 'inner');
        $this->db->join('xi_sa_group g', 'up.id_group = g.id_group', 'inner');
        $this->db->join('xi_sa_level_akses la', 'g.id_level_akses = la.id_level_akses', 'inner');
        $this->db->where('u.username', escape($username));
        $this->db->where('u.id_status', 1);
        $this->db->where('u.blokir', 0);
        $this->db->where('up.id_status', 1);
        $this->db->where('g.id_status', 1);
        $this->db->where('g.id_group', abs($group));
        $this->db->order_by('u.id_users');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function setLoginFailed($username, $ip_address, $user_agent) {
        $expiration = time()-3600;
        //delete fail login yang Lalu
        $this->db->where('login_time <', $expiration);
        $this->db->delete('xi_sa_log_login');
        //baru insert
        if($this->cekDataUserBlock($username) == FALSE){
            $data = array(
                'username' 		=> $username,
                'login_time'	=> time(),
                'ip_address'	=> $ip_address,
                'user_agent'	=> $user_agent
            );
            $this->db->insert('xi_sa_log_login', $data);
        }
    }

    public function getCountFailedLog($username) {
        $expiration = 3600;
        $this->db->where('username', $username);
        $this->db->where('login_time >', $expiration);
        $this->db->order_by('id_log', 'DESC');
        $query = $this->db->get('xi_sa_log_login');
        return $query;
    }

    public function setAccountUserBlock($username) {
        $this->db->set('blokir', 1);
        $this->db->where('blokir', 0);
        $this->db->where('username', $username);
        $this->db->update('xi_sa_users');
    }

    public function deleteFailedLog($username) {
        $this->db->where('username', $username);
        $this->db->delete('xi_sa_log_login');
    }

    public function setSuccessLog($username, $ip_address, $user_agent) {
        $date_array     = getdate();
        $session_time   = date('c',$date_array[0]);
        $session_value 	= $this->encryption->encrypt($session_time);
        $login_time     = time();
        $session = array('clear3ngine2022' => $session_value);
        $this->session->set_userdata($session);
        $getUser = $this->cekDataUsername($username);
        if(count($getUser) > 0) {
            $data = array(
                'id_users' 		=> $getUser['id_users'],
                'username' 		=> $username,
                'login_time'	=> $login_time,
                'ip_address'	=> $ip_address,
                'user_agent'	=> $user_agent,
                'id_status'		=> 1,
                'session_id'	=> $session_value
            );
            $this->db->insert('xi_sa_log_session', $data);
        }
        $result = (count($getUser) > 0) ? 'authtoken='.urlencode($session_value).'&time='.$login_time.'&ipaddress='.$ip_address.'&user='.$username : '';
        return $result;
    }

    public function updateDataSessionLog($session_id, $username, $ip_address, $user_agent) {
        $this->db->set('id_status', 0);
        $this->db->where('session_id', $session_id);
        $this->db->where('username', $username);
        //$this->db->where('ip_address', $ip_address);
        $this->db->where('user_agent', $user_agent);
        $this->db->update('xi_sa_log_session');
        return TRUE;
    }

    public function getDataSessionLog($username, $ip_address, $user_agent, $session_id) {
        $this->db->where('username', $username);
        $this->db->where('ip_address', $ip_address);
        $this->db->where('user_agent', $user_agent);
        $this->db->where('session_id', $session_id);
        $this->db->where('id_status', 1);
        $this->db->order_by('id_log_session', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('xi_sa_log_session');
        return $query->row_array();
    }

    public function cekSessionLog($username, $ip_address, $user_agent, $session_id) {

        $data = $this->getDataSessionLog($username, $ip_address, $user_agent, $session_id);

        if(count($data) > 0)
            return TRUE;
        else
            return FALSE;
    }

    public function cekSessionLogUser($username, $session_id, $ip_address, $login_time, $user_agent) {
        $this->db->where('username', $username);
        $this->db->where('login_time', $login_time);
        $this->db->where('ip_address', $ip_address);
        $this->db->where('user_agent', $user_agent);
        $this->db->where('session_id', $session_id);
        $this->db->where('id_status', 1);
        $this->db->order_by('id_log_session', 'DESC');
        $this->db->limit(1);
        $query = $this->db->count_all_results('xi_sa_log_session');
        return $query;
    }

    public function getDataUserRulesModule($username, $id_group) {
        $rules_access = array();
        $this->db->select('a.id_rules,
                           b.id_module,
                           b.id_kontrol,
                           b.id_fungsi,
                           c.nama_module,
                           c.url_module,
                           d.nama_kontrol,
                           d.url_kontrol,
                           e.nama_fungsi,
                           e.url_fungsi');
        $this->db->from('xi_sa_group_privileges a');
        $this->db->join('xi_sa_rules b', 'a.id_rules = b.id_rules', 'inner');
        $this->db->join('xi_sa_module c', 'b.id_module = c.id_module', 'inner');
        $this->db->join('xi_sa_kontrol d', 'b.id_kontrol = d.id_kontrol', 'inner');
        $this->db->join('xi_sa_fungsi e', 'b.id_fungsi = e.id_fungsi', 'inner');
        $this->db->where('a.id_group', abs($id_group));
        $this->db->where('a.id_status', 1);
        $this->db->where('b.id_status', 1);
        $this->db->where('c.id_status', 1);
        $this->db->where('d.id_status', 1);
        $this->db->where('e.id_status', 1);
        $this->db->order_by('b.id_rules', 'ASC');
        $query = $this->db->get();

        if(!empty($username)){
            foreach ($query->result_array() as $k => $v) {
                $url = $v['url_module'].'/'.$v['url_kontrol'].'/'.$v['url_fungsi'];
                $rules_access[] = str_replace('-', '_', $url);
            }
        }

        return $rules_access;
    }

    public function getDataWhiteList($module, $class, $method) {
        $this->db->where('module_name', $module);
        $this->db->where('class_name', $class);
        $this->db->where('method_name', $method);
        $this->db->where('id_status', 1);
        $query = $this->db->count_all_results('xi_sa_white_list');
        if($query > 0)
            return TRUE;
        else
            return FALSE;
    }
}

// This is the end of auth signin model
