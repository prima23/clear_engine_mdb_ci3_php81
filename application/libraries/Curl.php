<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Aplikasi Curl Library
 * Library untuk melakukan proses request data dari api
 * @author  Yogi Kaputra
 * @since   1.0
 */

class Curl
{
  var $user_agent;

  public function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->library('user_agent');
    $this->user_agent = ($this->CI->agent->is_browser()) ? $this->CI->agent->browser() : $this->CI->agent->mobile();
  }

  function get($url, $headers=false)
  {
    $process = curl_init();
    $ssl = stripos($url,'https://') === 0 ? true : false;
    curl_setopt($process, CURLOPT_URL, $url);
    curl_setopt($process, CURLOPT_USERAGENT, $this->user_agent);
    if($headers) {
      curl_setopt($process, CURLOPT_HTTPHEADER, array('Expect:'));
      curl_setopt($process, CURLOPT_HEADER, true);
    }
    curl_setopt($process, CURLOPT_NOBODY, false);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);
    curl_setopt($process, CURLOPT_MAXREDIRS, 4);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
    if ($ssl) {
      //support https
      curl_setopt($process, CURLOPT_SSL_VERIFYHOST, FALSE);
      curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
    }
    $return = curl_exec($process);
    if(curl_errno($process)) {
      //error message
      $return = curl_error($process);
    }
    curl_close($process);
    return $return;
  }

}


// This is the end of App_Loader
