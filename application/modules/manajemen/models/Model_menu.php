<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of fungsi model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_menu extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    /*get data list parent menu */
    public function getDataParentMenu() {
        $this->db->where('is_parent', 'Y');
        $this->db->order_by('id_menu', 'ASC');
        $this->db->order_by('order_menu', 'ASC');
        $query = $this->db->get('xi_sa_menu');
        $dd_parent[''] = 'Pilih Data';
        $dd_parent['0'] = 'Root';
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $r) {
                $dd_parent[$r['id_menu']] = $r['title_menu'];
            }
        }
        return $dd_parent;
    }

    /*get data list rules module index aktif */
    public function getDataRulesModule() {
        $this->db->select('a.id_rules,
                           b.url_module,
                           b.label_module,
                           c.url_kontrol,
                           c.label_kontrol,
                           d.url_fungsi,
                           d.label_fungsi');
        $this->db->from('xi_sa_rules a');
        $this->db->join('xi_sa_module b', 'a.id_module = b.id_module', 'inner');
        $this->db->join('xi_sa_kontrol c', 'a.id_kontrol = c.id_kontrol', 'inner');
        $this->db->join('xi_sa_fungsi d', 'a.id_fungsi = d.id_fungsi', 'inner');
        $this->db->where('a.id_status', 1);
        $this->db->where('d.id_jenis_fungsi', 1);
        $this->db->order_by('b.id_module', 'ASC');
        $this->db->order_by('c.id_kontrol', 'ASC');
        $this->db->order_by('d.id_fungsi', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /*Fungsi generate data list menu*/
    public function getDataListMenu() {
        $result = '';
        $mainmenu = $this->getDataListMenuWithParentID(0);
        foreach ($mainmenu as $main) {
            $ceksubmenu = $this->getDataListMenuWithParentID($main['id_menu']);
            $title = str_replace(' ', '-',  strtolower($main['title_menu']));
            $result .= '<tr>
                            <td>
                                <button class="btn btn-link px-0 py-0 mx-0 my-0 ml-1 font-weight-bold" data-toggle="collapse" data-target="#menu'.$main['id_menu'].'" aria-expanded="true" aria-controls="menu'.$main['id_menu'].'">
                                   '.$main['title_menu'].'
                                </button>
                             </td>
                            <td class="text-center">'.$main['order_menu'].'</td>
                            <td class="text-center">'.convert_status($main['id_status']).'</td>';
            if(($main['is_parent'] == 'Y') && (count($ceksubmenu) > 0))
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($main['id_menu']).'"><i class="fa fa-pencil-alt"></i> </button>
                                <button class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnAdd" data-id="'.$main['id_menu'].'"><i class="fa fa-plus-circle"></i> </button>
                            </td>';
            elseif(($main['is_parent'] == 'Y') && (count($ceksubmenu) == 0))
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($main['id_menu']).'"><i class="fas fa-pencil-alt"></i> </button>
                                <button class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($main['id_menu']).'"><i class="fas fa-trash-alt"></i> </button>
                                <button class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnAdd" data-id="'.$main['id_menu'].'"><i class="fas fa-plus-circle"></i> </button>
                            </td>';
            else
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($main['id_menu']).'"><i class="fas fa-pencil-alt"></i> </button>
                                <button class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($main['id_menu']).'"><i class="fas fa-trash-alt"></i> </button>
                            </td>
                        </tr>';
            if(count($ceksubmenu) > 0) {
                $submenu = $this->getDataSubMenu($main['id_menu']);
                $result .= $submenu;
            }
        }
        return $result;
    }

    private function getDataSubMenu($id_menu) {
        $result = '';
        $submenu = $this->getDataListMenuWithParentID($id_menu);
        foreach ($submenu as $sub) {
            $ceksubsubmenu = $this->getDataListMenuWithParentID($sub['id_menu']);
            $title = str_replace(' ', '-',  strtolower($sub['title_menu']));
            $result .= '<tr class="collapse show" id="menu'.$id_menu.'">
                            <td>
                                <button class="btn btn-link px-0 py-0 mx-0 my-0 ml-4" data-toggle="collapse" data-target="#menu'.$sub['id_menu'].'" aria-expanded="true" aria-controls="menu'.$sub['id_menu'].'">
                                   '.$sub['title_menu'].'
                                </button>
                             </td>
                            <td class="text-center">'.$sub['order_menu'].'</td>
                            <td class="text-center">'.convert_status($sub['id_status']).'</td>';
            if(($sub['is_parent'] == 'Y') && (count($ceksubsubmenu) > 0))
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($sub['id_menu']).'"><i class="fas fa-pencil-alt"></i> </button>
                                <button class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnAdd" data-id="'.$sub['id_menu'].'"><i class="fas fa-plus-circle"></i> </button>
                            </td>';
            elseif(($sub['is_parent'] == 'Y') && (count($ceksubsubmenu) == 0))
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($sub['id_menu']).'"><i class="fas fa-pencil-alt"></i> </button>
                                <button class="bbtn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($sub['id_menu']).'"><i class="fa fa-trash-alt"></i> </button>
                                <button class="btn btn-primary btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnAdd" data-id="'.$sub['id_menu'].'"><i class="fa fa-plus-circle"></i> </button>
                            </td>';
            else
                $result .= '<td class="text-center">
                                <button class="btn btn-orange btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnEdit" data-id="'.$this->encryption->encrypt($sub['id_menu']).'"><i class="fas fa-pencil-alt"></i> </button>
                                <button class="btn btn-danger btn-sm px-2 py-1 my-0 mx-0 waves-effect waves-light btnDelete" data-id="'.$this->encryption->encrypt($sub['id_menu']).'"><i class="fa fa-trash-alt"></i> </button>
                            </td>
                        </tr>';
            if(count($ceksubsubmenu) > 0){
                $subsubmenu = $this->getDataSubMenu($sub['id_menu']);
                $result .= $subsubmenu;
            }
        }
        return $result;
    }

    /*get data menu with parent id*/
    public function getDataListMenuWithParentID($parent_id) {
        $this->db->where('parent_id', abs($parent_id));
        $this->db->order_by('id_menu', 'ASC');
        $query = $this->db->get('xi_sa_menu');
        return $query->result_array();
    }

    /*Fungsi get data edit by id*/
    public function getDataDetailMenu($id) {
        $this->db->select('a.id_menu,
                           a.title_menu,
                           a.url_menu,
                           a.icon_menu,
                           a.order_menu,
                           a.id_rules,
                           a.parent_id,
                           a.is_parent,
                           a.id_status,
                           c.url_module,
                           d.url_kontrol,
                           e.url_fungsi');
        $this->db->from('xi_sa_menu a');
        $this->db->join('xi_sa_rules b', 'a.id_rules = b.id_rules', 'left');
        $this->db->join('xi_sa_module c', 'b.id_module = c.id_module', 'left');
        $this->db->join('xi_sa_kontrol d', 'b.id_kontrol = d.id_kontrol', 'left');
        $this->db->join('xi_sa_fungsi e', 'b.id_fungsi = e.id_fungsi', 'left');
        $this->db->where('a.id_menu', abs($id));
        $query = $this->db->get();
        return $query->row_array();
    }

    /* Fungsi untuk insert data */
    public function insertDataMenu() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $nama_menu   = escape($this->input->post('nama_menu', TRUE));
        $is_parent   = escape($this->input->post('is_parent', TRUE));
        $order_menu  = escape($this->input->post('order_menu', TRUE));
        $parent_id  = escape($this->input->post('parent_id', TRUE));
        //cek order no yg diinputkan
        $this->db->where('order_menu', $order_menu);
        $this->db->where('parent_id', $parent_id);
        $cekNo = $this->db->count_all_results('xi_sa_menu');
        if($cekNo > 0)
            return array('response'=>'ERROR', 'nama'=>$nama_menu, 'order'=>$order_menu);
        else {
            $data = array(
                'title_menu'    => $nama_menu,
                'url_menu'      => ($is_parent == 'Y') ? '#' : '',
                'icon_menu'     => escape($this->input->post('icon_menu', TRUE)),
                'order_menu'    => $order_menu,
                'id_rules'      => ($is_parent == 'Y') ? 0 : $this->encryption->decrypt(escape($this->input->post('id_rules', TRUE))),
                'parent_id'     => $parent_id,
                'is_parent'     => $is_parent,
                'create_by'     => $create_by,
                'create_date'   => $create_date,
                'create_ip'     => $create_ip,
                'mod_by'        => $create_by,
                'mod_date'      => $create_date,
                'mod_ip'        => $create_ip,
                'id_status'     => escape($this->input->post('status', TRUE))
            );
            /*query insert*/
            $this->db->insert('xi_sa_menu', $data);
            return array('response'=>'SUCCESS', 'nama'=>$nama_menu);
        }
    }

    /* Fungsi untuk update data */
    public function updateDataMenu() {
        //get data
        $create_by   = $this->app_loader->current_account();
        $create_date = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $create_ip   = $this->input->ip_address();
        $id_menu	 = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        $nama_menu   = escape($this->input->post('nama_menu', TRUE));
        $is_parent   = escape($this->input->post('is_parent', TRUE));
        $order_menu  = escape($this->input->post('order_menu', TRUE));
        $parent_id  = escape($this->input->post('parent_id', TRUE));
        //cek data menu by id
        $dataMenu = $this->getDataDetailMenu($id_menu);
        if(count($dataMenu) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            //cek order no yg diinputkan
            $this->db->where('order_menu', $order_menu);
            $this->db->where('parent_id', $parent_id);
            $this->db->where('id_menu !=', $id_menu);
            $cekNo = $this->db->count_all_results('xi_sa_menu');
            if($cekNo > 0)
                return array('response'=>'HAVENO', 'nama'=>$nama_menu, 'order'=>$order_menu);
            else {
                $data = array(
                    'title_menu'    => $nama_menu,
                    'url_menu'      => ($is_parent == 'Y') ? '#' : '',
                    'icon_menu'     => escape($this->input->post('icon_menu', TRUE)),
                    'order_menu'    => $order_menu,
                    'id_rules'      => ($is_parent == 'Y') ? 0 : $this->encryption->decrypt(escape($this->input->post('id_rules', TRUE))),
                    'parent_id'     => $parent_id,
                    'is_parent'     => $is_parent,
                    'mod_by'        => $create_by,
                    'mod_date'      => $create_date,
                    'mod_ip'        => $create_ip,
                    'id_status'     => escape($this->input->post('status', TRUE))
                );
                /*query update*/
                $this->db->where('id_menu', abs($id_menu));
                $this->db->update('xi_sa_menu', $data);
                return array('response'=>'SUCCESS', 'nama'=>$nama_menu);
            }
        }
    }

    /* Fungsi untuk delete data */
    public function deleteDataMenu() {
        $id_menu = $this->encryption->decrypt(escape($this->input->post('tokenId', TRUE)));
        //cek data menu by id
        $dataMenu  = $this->getDataDetailMenu($id_menu);
        $nama_menu = !empty($dataMenu) ? $dataMenu['title_menu'] : '';
        if (count($dataMenu) <= 0)
            return array('response'=>'ERROR', 'nama'=>'');
        else {
            $this->db->where('id_menu', abs($id_menu));
            $this->db->delete('xi_sa_menu');
            return array('response'=>'SUCCESS', 'nama'=>$nama_menu);
        }
    }
}

// This is the end of auth signin model
