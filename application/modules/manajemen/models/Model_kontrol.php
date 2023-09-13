<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of kontrol model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_kontrol extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*Fungsi Get Data List*/
    var $search = array('nama_kontrol', 'label_kontrol', 'url_kontrol', 'deskripsi_kontrol');
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
        return $this->db->count_all_results('xi_sa_kontrol');
    }

    private function _get_datatables_query() {
        $this->db->select('id_kontrol,
                           label_kontrol,
                           nama_kontrol,
                           url_kontrol,
                           deskripsi_kontrol,
                           id_status');
        $this->db->from('xi_sa_kontrol');
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
        $this->db->order_by('id_kontrol ASC');
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailKontrol($id) {
        $this->db->where('id_kontrol', abs($id));
        $query = $this->db->get('xi_sa_kontrol');
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataKontrol() {
        //get data
        $create_by    = $this->app_loader->current_account();
        $create_date  = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip    = $this->input->ip_address();
        $nama_kontrol = escape($this->input->post('nama_kontrol', TRUE));
        //cek nama kontrol duplicate
        $this->db->where('nama_kontrol', $nama_kontrol);
        $qTot = $this->db->count_all_results('xi_sa_kontrol');
        if($qTot > 0)
            return array('response'=>'ERROR', 'nama'=>$nama_kontrol);
        else {
            $data = array(
                'nama_kontrol'      => $nama_kontrol,
                'label_kontrol'     => escape($this->input->post('label_kontrol', TRUE)),
                'url_kontrol'       => escape($this->input->post('url_kontrol', TRUE)),
                'deskripsi_kontrol' => escape($this->input->post('deskripsi_kontrol', TRUE)),
                'create_by'         => $create_by,
                'create_date'       => $create_date,
                'create_ip'         => $create_ip,
                'mod_by'            => $create_by,
                'mod_date'          => $create_date,
                'mod_ip'            => $create_ip,
                'id_status'         => escape($this->input->post('status', TRUE))
            );
            /*query insert*/
            $this->db->insert('xi_sa_kontrol', $data);
            return array('response'=>'SUCCESS', 'nama'=>$nama_kontrol);
        }
    }

    /* Fungsi untuk update data */
    public function updateDataKontrol() {
        //get data
        $create_by    = $this->app_loader->current_account();
        $create_date  = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip    = $this->input->ip_address();
        $id_kontrol	  = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nama_kontrol = escape($this->input->post('nama_kontrol', TRUE));
        //cek data by id
        $dataKontrol = $this->getDataDetailKontrol($id_kontrol);
        if(count($dataKontrol) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //cek nama kontrol duplicate
            $this->db->where('nama_kontrol', $nama_kontrol);
            $this->db->where('id_kontrol !=', $id_kontrol);
            $qTot = $this->db->count_all_results('xi_sa_kontrol');
            if($qTot > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_kontrol);
            else {
                $data = array(
                    'nama_kontrol'      => $nama_kontrol,
                    'label_kontrol'     => escape($this->input->post('label_kontrol', TRUE)),
                    'url_kontrol'       => escape($this->input->post('url_kontrol', TRUE)),
                    'deskripsi_kontrol' => escape($this->input->post('deskripsi_kontrol', TRUE)),
                    'mod_by'            => $create_by,
                    'mod_date'          => $create_date,
                    'mod_ip'            => $create_ip,
                    'id_status'         => escape($this->input->post('status', TRUE))
                );
                /*query update*/
                $this->db->where('id_kontrol', abs($id_kontrol));
                $this->db->update('xi_sa_kontrol', $data);
                return array('response'=>'SUCCESS', 'nama'=>$nama_kontrol);
            }
        }
    }

    /* Fungsi untuk delete data */
    public function deleteDataKontrol() {
        $id = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data by id
        $dataKontrol = $this->getDataDetailKontrol($id);
        $nama_kontrol = !empty($dataKontrol) ? $dataKontrol['nama_kontrol'] : '';
        if (count($dataKontrol) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            $this->db->where('id_kontrol', abs($id));
            $count = $this->db->count_all_results('xi_sa_rules');
            if ($count > 0)
                return array('response'=>'ERRDATA', 'nama'=>$nama_kontrol);
            else {
                $this->db->where('id_kontrol', abs($id));
                $this->db->delete('xi_sa_kontrol');
                return array('response'=>'SUCCESS', 'nama'=>$nama_kontrol);
            }
        }
    }
}

// This is the end of auth signin model
