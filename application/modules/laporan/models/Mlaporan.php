<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of nontpp model
 *
 * @author prima aulia
 */

class Mlaporan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function totPembayaran()
    {

        $tahun = date('Y', mktime(0,0,0,date('m')-2));
        $bulan = date('m', mktime(0,0,0,date('m')-2));
        $query    = $this->db->query("call get_dashboard(?,?)",[$tahun,$bulan]);
        $res      = $query->row();
        $query->next_result();
        return $res;
    }

}

// This is the end of auth signin model
