<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of users model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('curl');
	}

	public function getDataGroup()
	{
		$this->db->where('id_status', '1');
		if (!$this->app_loader->is_super()) {
			$this->db->where_not_in('id_level_akses', array(1));
		}
		$this->db->order_by('id_level_akses ASC');
		$this->db->order_by('id_group ASC');
		$query = $this->db->get('xi_sa_group');
		$dd_group[''] = 'Pilih Group User';
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$dd_group[$row['id_group']] = $row['nama_group'];
			}
		}
		return $dd_group;
	}

	public function getDataListGroup()
	{
		$this->db->where('id_status', 1);
		if (!$this->app_loader->is_super()) {
			$this->db->where_not_in('id_level_akses', array(1));
		}
		$this->db->order_by('id_level_akses ASC');
		$this->db->order_by('id_group ASC');
		$query = $this->db->get('xi_sa_group');
		return $query->result_array();
	}

	public function getDataLevelAkses()
	{
		if (!$this->app_loader->is_super()) {
			$this->db->where('id_level_akses !=', 1);
		}
		$this->db->where('id_status', 1);
		$query = $this->db->get('xi_sa_level_akses');
		$dd_level[''] = 'Pilih Data';
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$dd_level[$row['id_level_akses']] = $row['level_akses'];
			}
		}
		return $dd_level;
	}

	var $search = array('a.username', 'a.fullname', 'c.nama_group','a.unit_id_name');

	public function get_datatables($param, $unit_id)
	{
		$this->_get_datatables_query($param, $unit_id);
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_filtered($param, $unit_id)
	{
		$this->_get_datatables_query($param, $unit_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($unit_id)
	{
		$this->db->select('a.id_users');
		$this->db->from('xi_sa_users a');
		$this->db->join('xi_sa_users_privileges b', 'a.id_users = b.id_users', 'left');
		$this->db->join('xi_sa_group c', 'b.id_group = c.id_group', 'left');
		if (!$this->app_loader->is_super()) {
			$this->db->where('c.id_level_akses !=', 1);
			$this->db->where('a.unit_id', $unit_id);
		}
		$this->db->group_by('a.id_users');
		return $this->db->count_all_results();
	}

	private function _get_datatables_query($param, $unit_id)
	{
		$post = array();
		if (is_array($param)) {
			foreach ($param as $v) {
				$post[$v['name']] = $v['value'];
			}
		}
		$this->db->select("a.id_users,
                           a.token,
                           a.unit_id,
                           a.username,
                           a.email,
                           a.fullname,
                           a.foto_profile,
                           a.blokir,
                           a.id_status,
						   a.unit_id_name,
                           (CASE
                               WHEN d.pass_plain IS NULL THEN '-'
                               ELSE d.pass_plain
                           END) AS pass_plain,
                           string_agg(c.nama_group, ', ') AS group_user");
		$this->db->from('xi_sa_users a');
		$this->db->join('xi_sa_users_privileges b', 'a.id_users = b.id_users', 'left');
		$this->db->join('xi_sa_group c', 'b.id_group = c.id_group', 'left');
		$this->db->join('xi_sa_users_default_pass d', 'a.id_users = d.id_users', 'left');
		$this->db->where('b.id_status', 1);
		if (!$this->app_loader->is_super()) {
			$this->db->where('c.id_level_akses !=', 1);
			$this->db->where('a.unit_id', $unit_id);
		}
		//unit instansi
		if (isset($post['unit']) and $post['unit'] != '')
			$this->db->where('a.unit_id', $post['unit']);
		//level
		if (isset($post['group']) and $post['group'] != '')
			$this->db->where('c.id_group', $post['group']);
		//blokir
		if (isset($post['blokir']) and $post['blokir'] != '')
			$this->db->where('a.blokir', $post['blokir']);
		//status
		if (isset($post['status']) and $post['status'] != '')
			$this->db->where('a.id_status', $post['status']);
		//username
		if (isset($post['username']) and $post['username'] != '')
			$this->db->like('a.username', $post['username'], 'after');
		//fullname
		if (isset($post['fullname']) and $post['fullname'] != '')
			$this->db->like('a.fullname', $post['fullname'], 'after');
		$i = 0;
		foreach ($this->search as $item) { // loop column
			if ($_POST['search']['value']) { // if datatable send POST for search
				if ($i === 0) { // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($this->search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		$this->db->group_by('a.id_users');
		$this->db->group_by('d.pass_plain');
		$this->db->order_by('a.id_users ASC');
	}

	/*Fungsi get data edit by id dan url*/
	public function getDataDetailUsers($token, $unit_id)
	{
		$this->db->select("a.id_users,
                           a.token,
                           a.unit_id,
                           a.username,
                           a.password,
                           a.email,
                           a.fullname,
                           a.foto_profile,
                           a.blokir,
                           a.id_status,
                           string_agg(b.id_group::varchar, ',') AS group_user");
		$this->db->from('xi_sa_users a');
		$this->db->join('xi_sa_users_privileges b', 'a.id_users = b.id_users', 'left');
		$this->db->where('a.token', $token);
		$this->db->where('b.id_status', 1);
		if (!$this->app_loader->is_super()) {
			$this->db->where('a.unit_id', $unit_id);
		}
		$this->db->group_by('a.id_users');
		$this->db->order_by('a.id_users ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}

	private function getDataUserByToken($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('xi_sa_users');
		return $query->row_array();
	}

	/* Fungsi untuk insert data */
	public function insertDataUsers()
	{
		$respon = "";
		$this->db->trans_start();
		//get data
		$create_by   = $this->app_loader->current_account();
		$create_date = date('Y-m-d H:i:s');
		$create_ip   = $this->input->ip_address();
		$username	 = escape($this->input->post('username', TRUE));
		$password 	 = escape($this->input->post('password', TRUE));
		$group		 = escape($this->input->post('groupid', TRUE));
		$fullname    = escape($this->input->post('fullname', TRUE));
		$unit   	 = escape($this->input->post('opd', TRUE));
		$unit_id_name= escape($this->input->post('unit_id_name', TRUE));
		$token		 = generateToken($username, $fullname);
		$data = array(
			'token'				  	    => $token,
			'unit_id'                   => $unit,
			'unit_id_name'				=> $unit_id_name,
			'username' 					=> $username,
			'password' 					=> $this->bcrypt->hash_password($password),
			'email' 					=> '',
			'fullname' 					=> $fullname,
			'foto_profile' 				=> 'default-user-icon.jpg',
			'blokir' 					=> escape($this->input->post('blokir', TRUE)),
			'id_status' 				=> escape($this->input->post('status', TRUE)),
			'validate_email_code'		=> '',
			'validate_email_status'		=> 0,
			'reset_password_code'		=> '',
			'reset_password_status'		=> 0,
			'reset_password_expired'	=> 0,
			'create_by' 				=> $create_by,
			'create_date' 				=> $create_date,
			'create_ip' 				=> $create_ip,
			'mod_by' 					=> $create_by,
			'mod_date' 					=> $create_date,
			'mod_ip' 					=> $create_ip
		);
		/*cek username yang diinputkan*/
		$this->db->where('username', $username);
		$qTot = $this->db->count_all_results('xi_sa_users');
		if ($qTot > 0)
			$respon = array('response' => 'ERROR', 'name' => $username);
		else {
			/*query insert*/
			$this->db->insert('xi_sa_users', $data);
			$id_users = $this->db->insert_id();
			/*query insert user password*/
			$this->db->insert('xi_sa_users_default_pass', array('id_users' => $id_users, 'pass_plain' => $password, 'updated' => 'N'));
			/*query insert user group privileges*/
			foreach ($group as $id) {
				$this->db->insert('xi_sa_users_privileges', array('id_users' => $id_users, 'id_group' => $this->encryption->decrypt($id), 'id_status' => 1));
			}
			$respon = array('response' => 'SUCCESS', 'name' => $username);
		}
		$this->db->trans_complete();
		return $respon;
	}

	/* Fungsi untuk update data */
	public function updateDataUsers($unit_id)
	{
		//get data
		$create_by   = $this->app_loader->current_account();
		$create_date = date('Y-m-d H:i:s');
		$create_ip   = $this->input->ip_address();
		$token   	 = escape($this->input->post('tokenId', TRUE));
		$username    = escape($this->input->post('username', TRUE));
		$password 	 = escape($this->input->post('password', TRUE));
		$group		 = escape($this->input->post('groupid', TRUE));
		$unit        = escape($this->input->post('opd', TRUE));
		$unit_id_name= escape($this->input->post('unit_id_name', TRUE));
		$data = array(
			'unit_id'       => $unit,
			'unit_id_name'  => $unit_id_name,
			'username'  	=> $username,
			'fullname' 		=> escape($this->input->post('fullname', TRUE)),
			'blokir'    	=> escape($this->input->post('blokir', TRUE)),
			'id_status' 	=> escape($this->input->post('status', TRUE)),
			'mod_by' 	  	=> $create_by,
			'mod_date'  	=> $create_date,
			'mod_ip'    	=> $create_ip
		);
		if ($password != "")
			$data = array_merge($data, array('password' => $this->bcrypt->hash_password($password)));
		//get data user by token
		$dataUser = $this->getDataUserByToken($token);
		$id_users = !empty($dataUser) ? $dataUser['id_users'] : 0;
		//cek data user ditemukan atau tidak
		if (count($dataUser) <= 0)
			return array('response' => 'NODATA', 'nama' => $username);
		else {
			//cek nama username biar tidak terjadi duplikat data
			$this->db->where('username', $username);
			$this->db->where('id_users !=', $id_users);
			$nUser = $this->db->count_all_results('xi_sa_users');
			if ($nUser > 0)
				return array('response' => 'ERROR', 'nama' => $username);
			else {
				/*query update*/
				$this->db->where('id_users', $id_users);
				$this->db->where('token', $token);
				$this->db->update('xi_sa_users', $data);
				/*query update user password*/
				if ($password != "") {
					$this->db->set('pass_plain', $password);
					$this->db->where('id_users', abs($id_users));
					$this->db->update('xi_sa_users_default_pass');
				}
				/*query update user group privileges*/
				$this->db->set('id_status', 0);
				$this->db->where('id_users', abs($id_users));
				$this->db->update('xi_sa_users_privileges');
				foreach ($group as $id) {
					$this->db->where('id_users', abs($id_users));
					$this->db->where('id_group', abs($this->encryption->decrypt($id)));
					$nGroup = $this->db->count_all_results('xi_sa_users_privileges');
					if ($nGroup > 0) {
						//update status group privileges jadi 1
						$this->db->set('id_status', 1);
						$this->db->where('id_users', abs($id_users));
						$this->db->where('id_group', abs($this->encryption->decrypt($id)));
						$this->db->update('xi_sa_users_privileges');
					} else
						$this->db->insert('xi_sa_users_privileges', array('id_users' => $id_users, 'id_group' => $this->encryption->decrypt($id), 'id_status' => 1));
				}
				return array('response' => 'SUCCESS', 'nama' => $username);
			}
		}
	}

	public function deleteDataUsers($unit_id)
	{
		$users = escape($this->input->post('tokenId', TRUE));
		//jika ingin menghapus data lakukan looping
		foreach ($users as $id) {
			/*query delete*/
			if (!$this->app_loader->is_super()) {
				$this->db->where('unit_id', $unit_id);
			}
			$this->db->where('token', $id);
			$this->db->delete('xi_sa_users');
		}
		return array('response' => 'SUCCESS');
	}

	public function searchDataUsername($username)
	{
		$this->db->where('username', $username);
		return $this->db->count_all_results('xi_sa_users');
	}

	public function getDataUserPassword($id_users)
	{
		$this->db->select('pass_plain');
		$this->db->where('id_users', $id_users);
		$query = $this->db->get('xi_sa_users_default_pass');
		return $query->row_array();
	}

	public function getDataUserGroup($id_users)
	{
		$this->db->select('p.id_group, 
		                   g.nama_group');
		$this->db->from('xi_sa_users_privileges p');
		$this->db->join('xi_sa_group g', 'g.id_group = p.id_group', 'inner');
		$this->db->where('p.id_users', $id_users);
		$this->db->where('p.id_status', 1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDataUserGroupPrivileges($id_users)
	{
		$this->db->where('id_users', abs($id_users));
		$this->db->where('id_status', 1);
		$query = $this->db->get('xi_sa_users_privileges');
		return $query->result_array();
	}

    public function getOptionOpd()
    {
        $dataopd = json_decode($this->curl->get('http://simpeg.bkd.sumbarprov.go.id/webapi/instansi/unit-kerja/utama/token/XBnKaywRCrj05m-XXX-v6DXuZ3FFkUgiw45'), true);
        $dd = '<option value="">Pilih Data</option>';
        array_sort_by_column($dataopd['result'],'opdName',SORT_ASC);
        if (count($dataopd['result']) > 0) {
            foreach ($dataopd['result'] as $row) {
                $dd .= '<option value="'.$row['opdId'].'">'.ucwords(strtolower($row['opdName'])).'</option>';
            }
        }
        return $dd;
    }


}

// This is the end of auth signin model
