<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of model odp
 *
 * @author Yogi "solop" Kaputra
 */

class Model_master extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

    public function getDataProvince() {
        $this->db->where('id', '13');
        $this->db->order_by('id ASC');
        $query = $this->db->get('wa_province');
        $dd_prov[''] = 'Pilih Provinsi';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_prov[$row['id']] = $row['name'];
            }
        }
        return $dd_prov;
    }

    public function getDataRegency() {
        $this->db->where('province_id', '13');
        $this->db->order_by('id ASC');
        $query = $this->db->get('wa_regency');
        $dd_reg[''] = 'Pilih Daerah';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_reg[$row['id']] = ($row['status'] == 1) ? "KAB ".$row['name'] : $row['name'];
            }
        }
        return $dd_reg;
    }

    public function getDataRegencyByProvince($id) {
		$this->db->where('province_id', $id);
        $this->db->order_by('status ASC');
		$this->db->order_by('name ASC');
		$query = $this->db->get('wa_regency');
        return $query->result_array();
    }

    public function getDataDistrictByRegency($id) {
		$this->db->where('regency_id', $id);
		$this->db->order_by('id ASC');
		$query = $this->db->get('wa_district');
        return $query->result_array();
    }

    public function getDataVillageByDistrict($id) {
        $this->db->where('district_id', $id);
        $this->db->order_by('id ASC');
        $query = $this->db->get('wa_village');
        return $query->result_array();
    }

    public function getDataStatusNikah() {
        $this->db->order_by('id_nikah ASC');
        $query = $this->db->get('ref_status_nikah');
        $dd_data[''] = 'Pilih Data';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_data[$row['id_nikah']] = $row['status_nikah'];
            }
        }
        return $dd_data;
    }

    public function getDataStudy() {
        $this->db->order_by('id ASC');
        $query = $this->db->get('ref_pendidikan');
        $dd_data[''] = 'Pilih Data';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $dd_data[$row['id']] = $row['study'];
            }
        }
        return $dd_data;
    }
}

// This is the end of auth signin model
