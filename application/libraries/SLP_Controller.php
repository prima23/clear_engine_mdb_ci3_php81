<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of SLP_Controller class
 *
 * @author  Yogi Kaputra
 * @since   1.0
 *
 *
 */

class SLP_Controller extends MY_Controller {

  protected $session_info = array();

  public function __construct() {
    parent::__construct();
    $setApps = setApps();
    $appname = !empty($setApps) ? $setApps['app_name'] : 'clear engine';
    $year    = !empty($setApps) ? $setApps['app_year'] : date('Y');
    $author  = !empty($setApps) ? $setApps['app_author'] : 'Dinas Komunikasi, Informatika dan Statistik';
    $versi   = !empty($setApps) ? $setApps['app_versi'] : 'Alfa 2';
    $this->session_info['app_name']   = $appname;
    $this->session_info['app_author'] = $author;
    $this->session_info['app_footer'] = 'Copyright &copy; '.((date('Y') == $year) ? $year : $year.' - '.date('Y')).' <br> <a href="javascript:void(0)">'.$author.'</a> <br> Aplikasi '.$appname.'. '.$versi;
    $this->session_info['app_descs']  = !empty($setApps) ? $setApps['app_description'] : '';
    $this->session_info['app_keys']   = !empty($setApps) ? $setApps['app_keywords'] : '';
    $this->session_info['app_favico'] = !empty($setApps) ? $setApps['app_favicon'] : '';
    $this->session_info['appIcon']    = !empty($setApps) ? $setApps['app_icon'] : '';
    $this->template->enable_parser(FALSE); // default true
    $this->template->set_partial('header', 'layouts/partials/header', FALSE);
    $this->template->set_partial('title', 'layouts/partials/title', FALSE);
    $this->template->set_partial('navigation', 'layouts/partials/navigation', FALSE);
    $this->template->set_partial('footer', 'layouts/partials/footer', FALSE);
    $this->template->set_partial('javascript', 'layouts/partials/javascript', FALSE);
  }

}

// This is the end of WRC_AdminCont class
