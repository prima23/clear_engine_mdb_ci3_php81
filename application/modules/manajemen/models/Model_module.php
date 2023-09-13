<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of kontrol model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_module extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('nama_module', 'label_module', 'url_module', 'deskripsi_module');
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
        return $this->db->count_all_results('xi_sa_module');
    }

    private function _get_datatables_query() {
        $this->db->select('id_module,
                           label_module,
                           nama_module,
                           url_module,
                           deskripsi_module,
                           id_status');
        $this->db->from('xi_sa_module');
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
        $this->db->order_by('id_module ASC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailModule($id) {
        $this->db->where('id_module', abs($id));
        $query = $this->db->get('xi_sa_module');
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataModule() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $nama_module = escape($this->input->post('nama_module', TRUE));
        //cek nama kontrol duplicate
        $this->db->where('nama_module', $nama_module);
        $qTot = $this->db->count_all_results('xi_sa_module');
        if($qTot > 0)
            return array('response'=>'ERROR', 'nama'=>$nama_module);
        else {
            $data = array(
                'nama_module'      => $nama_module,
                'label_module'     => escape($this->input->post('label_module', TRUE)),
                'url_module'       => escape($this->input->post('url_module', TRUE)),
                'deskripsi_module' => escape($this->input->post('deskripsi_module', TRUE)),
                'create_by'        => $create_by,
                'create_date'      => $create_date,
                'create_ip'        => $create_ip,
                'mod_by'           => $create_by,
                'mod_date'         => $create_date,
                'mod_ip'           => $create_ip,
                'id_status'        => escape($this->input->post('status', TRUE))
            );
            /*query insert*/
            $this->db->insert('xi_sa_module', $data);
            return array('response'=>'SUCCESS', 'nama'=>$nama_module);
        }
    }

    /* Fungsi untuk update data */
    public function updateDataModule() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $id_module	 = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nama_module = escape($this->input->post('nama_module', TRUE));
        //cek data by id
        $dataModule = $this->getDataDetailModule($id_module);
        if(count($dataModule) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //cek nama module duplicate
            $this->db->where('nama_module', $nama_module);
            $this->db->where('id_module !=', $id_module);
            $qTot = $this->db->count_all_results('xi_sa_module');
            if($qTot > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_module);
            else {
                $data = array(
                    'nama_module'      => $nama_module,
                    'label_module'     => escape($this->input->post('label_module', TRUE)),
                    'url_module'       => escape($this->input->post('url_module', TRUE)),
                    'deskripsi_module' => escape($this->input->post('deskripsi_module', TRUE)),
                    'mod_by'           => $create_by,
                    'mod_date'         => $create_date,
                    'mod_ip'           => $create_ip,
                    'id_status'        => escape($this->input->post('status', TRUE))
                );
                /*query update*/
                $this->db->where('id_module', abs($id_module));
                $this->db->update('xi_sa_module', $data);
                return array('response'=>'SUCCESS', 'nama'=>$nama_module);
            }
        }
    }

    /* Fungsi untuk delete data */
    public function deleteDataModule() {
        $id = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data by id
        $dataModule = $this->getDataDetailModule($id);
        $nama_module = !empty($dataModule) ? $dataModule['nama_module'] : '';
        if (count($dataModule) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            $this->db->where('id_module', abs($id));
            $count = $this->db->count_all_results('xi_sa_rules');
            if ($count > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_module);
            else {
                $this->db->where('id_module', abs($id));
                $this->db->delete('xi_sa_module');
                return array('response'=>'SUCCESS', 'nama'=>$nama_module);
            }
        }
    }

    /* get data rules module */
    public function getDataRulesModule($id_module) {
        $this->db->select('a.id_rules,
                           a.id_module,
                           a.id_kontrol,
                           a.id_fungsi,
                           a.id_status,
                           b.nama_kontrol,
                           b.label_kontrol,
                           c.nama_fungsi,
                           c.label_fungsi');
        $this->db->from('xi_sa_rules a');
        $this->db->join('xi_sa_kontrol b', 'a.id_kontrol = b.id_kontrol', 'inner');
        $this->db->join('xi_sa_fungsi c', 'a.id_fungsi = c.id_fungsi', 'inner');
        $this->db->where('a.id_module', abs($id_module));
        $this->db->where('b.id_status', 1);
        $this->db->where('c.id_status', 1);
        $this->db->where_in('c.id_jenis_fungsi', array(1,2));
        $this->db->order_by('b.id_kontrol', 'ASC');
        $this->db->order_by('c.id_fungsi', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataKontrolAll() {
        $this->db->where('id_status', 1);
        $this->db->order_by('id_kontrol', 'ASC');
        $query = $this->db->get('xi_sa_kontrol');
        $dd_kontrol[''] = 'Pilih Data';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dd_kontrol[$row->id_kontrol] = $row->label_kontrol;
            }
        }
        return $dd_kontrol;
    }

    public function getDataFungsiAll() {
        $this->db->where('id_status', 1);
        $this->db->where_in('xi_sa_fungsi.id_jenis_fungsi', array(1,2));
        $this->db->order_by('id_fungsi', 'ASC');
        $query = $this->db->get('xi_sa_fungsi');
        $dd_fungsi = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $dd_fungsi[$row->id_fungsi] = $row->label_fungsi;
            }
        }
        return $dd_fungsi;
    }

    /* Fungsi untuk insert data */
    public function insertDataModuleRules() {
        //get data
        $id_module	= $this->encryption->decrypt(escape($this->input->post('tokenRules', TRUE)));
        $id_kontrol = escape($this->input->post('nama_kontrol', TRUE));
        $fungsi 	= escape($this->input->post('nama_fungsi', TRUE));
        //cek data by id
        $dataModule = $this->getDataDetailModule($id_module);
        $nama_module = !empty($dataModule) ? $dataModule['nama_module'] : '';
        if (count($dataModule) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            /*query insert*/
            foreach ($fungsi as $key => $id) {
                /*cek data kontrol*/
                $this->db->where('id_module', abs($id_module));
                $this->db->where('id_kontrol', abs($id_kontrol));
                $this->db->where('id_fungsi', abs($id));
                $qTot = $this->db->count_all_results('xi_sa_rules');
                if($qTot <= 0) {
                    $data = array(
                        'id_module'  => $id_module,
                        'id_kontrol' => $id_kontrol,
                        'id_fungsi'  => $id,
                        'id_status'  => escape($this->input->post('status_rules', TRUE))
                    );
                    $this->db->insert('xi_sa_rules', $data);
                }
            }
            return array('response'=>'SUCCESS','nama'=>$nama_module);
        }
    }

    /* Fungsi untuk update data */
    public function updateDataModuleRules() {
        //get data
        $id    = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $flag  = $this->encryption->decrypt(escape($this->input->post('flag', TRUE)));
        $rules = escape($this->input->post('rulesId', TRUE));
        //cek data by id
        $dataModule = $this->getDataDetailModule($id);
        $nama_module = !empty($dataModule) ? $dataModule['nama_module'] : '';
        if (count($dataModule) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            foreach ($rules as $key => $r) {
                $this->db->where('id_rules', abs($this->encryption->decrypt($r)));
                $this->db->where('id_module', abs($id));
                if($flag == "AR") {
                    $this->db->update('xi_sa_rules', array('id_status' => 1));
                } elseif($flag == "NR") {
                    $this->db->update('xi_sa_rules', array('id_status' => 0));
                } elseif($flag == "DR") {
                    $this->db->delete('xi_sa_rules');
                }
            }
            return array('response'=>'SUCCESS', 'nama'=>$nama_module);
        }
    }
}

// This is the end of auth signin model
