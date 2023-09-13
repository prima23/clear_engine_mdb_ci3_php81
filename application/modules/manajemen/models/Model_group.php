<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of group model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_group extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getDataLevelAkses() {
        $this->db->where('id_status', 1);
        $this->db->order_by('id_level_akses', 'ASC');
        $query = $this->db->get('xi_sa_level_akses');
        $dd_level[''] = 'Pilih Data';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_level[$row['id_level_akses']] = $row['level_akses'];
            }
        }
        return $dd_level;
    }

    /*Fungsi Get Data List*/
    var $search = array('a.nama_group', 'e.level_akses', 'd.label_module');
    public function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        return $this->db->count_all_results('xi_sa_group');
    }

    private function _get_datatables_query() {
        $this->db->select("a.id_group,
                           a.nama_group,
                           a.id_level_akses,
                           a.id_status,
                           CONCAT ( 'Module: ', string_agg(distinct(d.label_module), ', ' ) ) AS hak_akses,
                           e.level_akses");
        $this->db->from('xi_sa_group a');
        $this->db->join('xi_sa_group_privileges b', 'a.id_group = b.id_group AND b.id_status = 1', 'left');
        $this->db->join('xi_sa_rules c', 'b.id_rules = c.id_rules', 'left');
        $this->db->join('xi_sa_module d', 'c.id_module = d.id_module', 'left');
        $this->db->join('xi_sa_level_akses e', 'a.id_level_akses = e.id_level_akses', 'inner');
        $i = 0;
        foreach ($this->search as $item) { // loop column
            if($_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $this->db->group_by('a.id_group');
        $this->db->group_by('e.level_akses');
        $this->db->order_by('a.id_group', 'ASC');
    }

    /*Fungsi get data by id*/
    public function getDataDetailGroup($id) {
        $this->db->where('id_group', abs($id));
        $query = $this->db->get('xi_sa_group');
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataGroup() {
        //get data
        $create_by     = $this->app_loader->current_account();
        $create_date   = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip     = $this->input->ip_address();
        $nama_group    = escape($this->input->post('nama_group', TRUE));
        $data = array(
            'nama_group'     => $nama_group,
            'id_level_akses' => escape($this->input->post('level_akses', TRUE)),
            'create_by'      => $create_by,
            'create_date'    => $create_date,
            'create_ip'      => $create_ip,
            'mod_by'         => $create_by,
            'mod_date'       => $create_date,
            'mod_ip'         => $create_ip,
            'id_status'      => escape($this->input->post('status', TRUE))
        );
        /*query insert*/
        $this->db->insert('xi_sa_group', $data);
        return array('response'=>'SUCCESS', 'nama'=>$nama_group);
    }

    /* Fungsi untuk update data */
    public function updateDataGroup() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $id_group	 = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nama_group  = escape($this->input->post('nama_group', TRUE));
        //cek data unit by id
        $dataGroup = $this->getDataDetailGroup($id_group);
        if(count($dataGroup) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            $data = array(
                'nama_group'     => $nama_group,
                'id_level_akses' => escape($this->input->post('level_akses', TRUE)),
                'mod_by'         => $create_by,
                'mod_date'       => $create_date,
                'mod_ip'         => $create_ip,
                'id_status'      => escape($this->input->post('status', TRUE))
            );
            /*query update*/
            $this->db->where('id_group', abs($id_group));
            $this->db->update('xi_sa_group', $data);
            return array('response'=>'SUCCESS', 'nama'=>$nama_group);
        }
    }

    public function deleteDataGroup() {
        $id_group = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data group by id
        $dataGroup = $this->getDataDetailGroup($id_group);
        $nama_group = !empty($dataGroup) ? $dataGroup['nama_group'] : '';
        if (count($dataGroup) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //cek group yg dihapus tidak boleh ada yang menggunakan
            $this->db->where('id_group', abs($id_group));
            $qTot = $this->db->count_all_results('xi_sa_users_privileges');
            if($qTot > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_group);
            else {
                /*query delete*/
                $this->db->where('id_group', abs($id_group));
                $this->db->delete('xi_sa_group');
                /*delete group privileges*/
                $this->db->where('id_group', abs($id_group));
                $this->db->delete('xi_sa_group_privileges');
                /*delete user group privileges*/
                $this->db->where('id_group', abs($id_group));
                $this->db->delete('xi_sa_users_privileges');
                return array('response'=>'SUCCESS', 'nama'=>$nama_group);
            }
        }
    }

    /* get data all rules module*/
    public function getDataAllRulesModule() {
        $this->db->select('a.id_rules,
                           b.label_module,
                           c.label_kontrol,
                           d.label_fungsi');
        $this->db->from('xi_sa_rules a');
        $this->db->join('xi_sa_module b', 'a.id_module = b.id_module', 'inner');
        $this->db->join('xi_sa_kontrol c', 'a.id_kontrol = c.id_kontrol', 'inner');
        $this->db->join('xi_sa_fungsi d', 'a.id_fungsi = d.id_fungsi', 'inner');
        $this->db->where('a.id_status', 1);
        $this->db->order_by('b.id_module', 'ASC');
        $this->db->order_by('c.id_kontrol', 'ASC');
        $this->db->order_by('d.id_fungsi', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /* get data rules by group from group privileges */
    public function getDataRulesGroupPrivileges($id_group) {
        $this->db->select('id_rules');
        $this->db->from('xi_sa_group_privileges a');
        $this->db->join('xi_sa_group b', 'a.id_group = b.id_group', 'inner');
        $this->db->where('a.id_group', abs($id_group));
        $this->db->where('a.id_status', 1);
        $this->db->where('b.id_status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*insert data group privileges*/
    public function insertDataGroupPrivilege() {
        //get data
        $id_group = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $rules    = escape($this->input->post('rulesId', TRUE));
        //cek data group by id
        $dataGroup = $this->getDataDetailGroup($id_group);
        $nama_group = !empty($dataGroup) ? $dataGroup['nama_group'] : '';
        if (count($dataGroup) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //update status group privileges berdasarkan id group
            $this->db->set('id_status', 0);
            $this->db->where('id_group', abs($id_group));
            $this->db->update('xi_sa_group_privileges');
            if(!empty($rules)){
                foreach ($rules as $key => $r) {
                    $this->db->where('id_group', abs($id_group));
                    $this->db->where('id_rules', abs($this->encryption->decrypt($r)));
                    $cekData = $this->db->count_all_results('xi_sa_group_privileges');
                    if($cekData > 0) {
                        //update status group privileges jadi 1
                        $this->db->set('id_status', 1);
                        $this->db->where('id_group', abs($id_group));
                        $this->db->where('id_rules', abs($this->encryption->decrypt($r)));
                        $this->db->update('xi_sa_group_privileges');
                    } else {
                        //insert data group privileges
                        $data = array('id_group' => $id_group, 'id_rules' => $this->encryption->decrypt($r), 'id_status' => 1);
                        $this->db->insert('xi_sa_group_privileges', $data);
                    }
                }
            }
            return array('response'=>'SUCCESS', 'nama'=>$nama_group);
        }
    }
}

// This is the end of auth signin model
