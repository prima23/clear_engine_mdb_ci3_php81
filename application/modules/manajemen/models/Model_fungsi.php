<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of fungsi model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_fungsi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getDataJenisFungsi() {
        $this->db->where('id_status', 1);
        $this->db->order_by('id_jenis_fungsi', 'ASC');
        $query = $this->db->get('xi_sa_jenis_fungsi');
        $dd_fungsi[''] = 'Pilih Data';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_fungsi[$row['id_jenis_fungsi']] = $row['jenis_fungsi'];
            }
        }
        return $dd_fungsi;
    }

    public function getDataLevelAkses() {
        $this->db->where('id_status', 1);
        $this->db->order_by('id_level_akses', 'ASC');
        $query = $this->db->get('xi_sa_level_akses');
        return $query->result();
    }

    /*Fungsi Get Data List*/
    var $search = array('a.nama_fungsi', 'a.label_fungsi', 'a.url_fungsi', 'a.deskripsi_fungsi', 'b.jenis_fungsi');
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
        return $this->db->count_all_results('xi_sa_fungsi');
    }

    private function _get_datatables_query() {
        $this->db->select('a.id_fungsi,
                           a.label_fungsi,
                           a.nama_fungsi,
                           a.url_fungsi,
                           a.deskripsi_fungsi,
                           a.id_jenis_fungsi,
                           a.id_level_akses,
                           a.id_status,
                           b.jenis_fungsi');
        $this->db->from('xi_sa_fungsi a');
        $this->db->join('xi_sa_jenis_fungsi b', 'a.id_jenis_fungsi = b.id_jenis_fungsi', 'inner');
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
        $this->db->order_by('a.id_fungsi ASC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailFungsi($id) {
        $this->db->where('id_fungsi', abs($id));
        $query = $this->db->get('xi_sa_fungsi');
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataFungsi() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $nama_fungsi = escape($this->input->post('nama_fungsi', TRUE));
        //cek nama fungsi duplicate
        $this->db->where('nama_fungsi', $nama_fungsi);
        $qTot = $this->db->count_all_results('xi_sa_fungsi');
        if($qTot > 0)
			return array('response'=>'ERROR', 'nama'=>$nama_fungsi);
		else {
            $data = array(
                'nama_fungsi'       => $nama_fungsi,
                'label_fungsi'      => escape($this->input->post('label_fungsi', TRUE)),
                'url_fungsi'        => escape($this->input->post('url_fungsi', TRUE)),
                'deskripsi_fungsi'  => escape($this->input->post('deskripsi_fungsi', TRUE)),
                'id_jenis_fungsi'   => escape($this->input->post('jenis_fungsi', TRUE)),
                'create_by'         => $create_by,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $create_by,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip,
                'id_status'         => escape($this->input->post('status', TRUE))
            );
            /*query insert*/
            $this->db->insert('xi_sa_fungsi', $data);
            return array('response'=>'SUCCESS', 'nama'=>$nama_fungsi);
        }
    }

    /* Fungsi untuk update data */
    public function updateDataFungsi() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $id_fungsi	 = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nama_fungsi = escape($this->input->post('nama_fungsi', TRUE));
        //cek data by id
        $dataFungsi = $this->getDataDetailFungsi($id_fungsi);
        if(count($dataFungsi) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //cek nama fungsi duplicate
            $this->db->where('nama_fungsi', $nama_fungsi);
            $this->db->where('id_fungsi !=', $id_fungsi);
            $qTot = $this->db->count_all_results('xi_sa_fungsi');
            if($qTot > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_fungsi);
            else {
                $data = array(
                    'nama_fungsi'       => $nama_fungsi,
                    'label_fungsi'      => escape($this->input->post('label_fungsi', TRUE)),
                    'url_fungsi'        => escape($this->input->post('url_fungsi', TRUE)),
                    'deskripsi_fungsi'  => escape($this->input->post('deskripsi_fungsi', TRUE)),
                    'id_jenis_fungsi'   => escape($this->input->post('jenis_fungsi', TRUE)),
                    'mod_by'            => $create_by,
                    'mod_date'          => $create_date,
                    'mod_ip'            => $create_ip,
                    'id_status'         => escape($this->input->post('status', TRUE))
                );
                /*query update*/
                $this->db->where('id_fungsi', abs($id_fungsi));
                $this->db->update('xi_sa_fungsi', $data);
                return array('response'=>'SUCCESS', 'nama'=>$nama_fungsi);
            }
        }
    }

    /* Fungsi untuk delete data */
    public function deleteDataFungsi() {
        $id = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data by id
        $dataFungsi   = $this->getDataDetailFungsi($id);
        $nama_fungsi  = !empty($dataFungsi) ? $dataFungsi['nama_fungsi'] : '';
        if(count($dataFungsi) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            $this->db->where('id_fungsi', abs($id));
            $count = $this->db->count_all_results('xi_sa_rules');
            if($count > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_fungsi);
            else {
                $this->db->where('id_fungsi', abs($id));
                $this->db->delete('xi_sa_fungsi');
                return array('response'=>'SUCCESS', 'nama'=>$nama_fungsi);
            }
        }
    }
}

// This is the end of auth signin model
