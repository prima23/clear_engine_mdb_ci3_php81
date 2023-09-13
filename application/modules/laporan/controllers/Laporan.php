<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of home class
 *
 * @author Prima Aulia
 */

class Laporan extends SLP_Controller {
    protected $_vwName  = '';
    protected $_uriName = '';
    public function __construct() {
        parent::__construct();
        $this->load->model(array('Mlaporan' => 'modelu'));
        $this->_vwName  = '';
        $this->_uriName = 'laporan/laporan';
    }

    public function index() {
        $this->breadcrumb->add('Dashboard', site_url('home'));
        $this->breadcrumb->add('Nontpp', '#');
        $this->breadcrumb->add('Module', site_url($this->_uriName));
        $this->session_info['page_name'] = "Home";
        $this->session_info['page_css']	 = '';
        $this->session_info['page_js']         = $this->load->view($this->_vwName . '/vjs', array('siteUri' => $this->_uriName), true);
        $this->session_info['data_pembayaran']   = $this->modelu->totPembayaran();
        $this->session_info['bulan']   = bulan(date('m', mktime(0,0,0,date('m')-2)));
        $this->session_info['tahun']   = date('Y', mktime(0,0,0,date('m')-2));
        $this->template->build('vpage', $this->session_info);
    }
}

// This is the end of home clas
