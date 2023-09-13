<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of generate menu model
 *
 * @author Yogi "solop" Kaputra
 */

class Model_generate_menu extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDataMenu()
    {
        $this->db->select("a.id_menu,
                           a.title_menu,
                           (
                            CASE
                                    a.is_parent 
                                    WHEN 'Y' THEN
                                    a.url_menu 
                            ELSE
                                case lower(C.url_module)
                                    when lower(d.url_kontrol) then 
                                        case lower(e.url_fungsi)
                                            when 'index' then lower(C.url_module)
                                        else
                                            CONCAT(lower(C.url_module ), '/', lower(e.url_fungsi))
                                        END
                                else
                                        case lower(e.url_fungsi)
                                            when 'index' then CONCAT(lower(C.url_module), '/', lower(d.url_kontrol))
                                        else
                                            CONCAT(lower(C.url_module), '/', lower(d.url_kontrol), '/', lower(e.url_fungsi))
                                        END
                                end
                                
                            END 
                                ) AS url_menu,
                           a.icon_menu,
                           a.order_menu,
                           a.id_rules,
                           a.parent_id,
                           a.is_parent");
        $this->db->from('xi_sa_menu a');
        $this->db->join('xi_sa_rules b', 'b.id_rules = a.id_rules', 'left');
        $this->db->join('xi_sa_module c', 'c.id_module = b.id_module', 'left');
        $this->db->join('xi_sa_kontrol d', 'd.id_kontrol = b.id_kontrol', 'left');
        $this->db->join('xi_sa_fungsi e', 'e.id_fungsi = b.id_fungsi', 'left');
        $this->db->join('xi_sa_group_privileges f', 'f.id_rules = b.id_rules', 'left');
        $this->db->join('xi_sa_group g', 'g.id_group = f.id_group', 'left');
        $this->db->where('a.id_status', 1);
        $this->db->where('b.id_status', 1);
        $this->db->where('c.id_status', 1);
        $this->db->where('d.id_status', 1);
        $this->db->where('e.id_status', 1);
        $this->db->where('f.id_status', 1);
        $this->db->where('g.id_status', 1);
        $this->db->where('g.id_group', $this->app_loader->current_group());
        $this->db->order_by('a.id_menu ASC');
        $this->db->order_by('a.order_menu ASC');
        $this->db->get();
        $query1 = $this->db->last_query();
                
        /*-------------------------------ambil parent-----------------------------*/
        $menus = "";
        $getParent = $this->db->query($query1);
        //dd($getParent->result());
        foreach ($getParent->result() as $id) {
            if ($id->parent_id != 0) {
                $menus .= $this->getMenuParent($id->parent_id);
            }
        }

        $parentID = explode(',', substr(trim($menus), 0, -1));
        /*------------------------------------------------------------------------*/

        if (empty($parentID[0])) {
            $query = $this->db->query($query1);
        } else {
            $this->db->select('id_menu,
            title_menu,
            url_menu,
            icon_menu,
            order_menu,
            id_rules,
            parent_id,
            is_parent');
            $this->db->from('xi_sa_menu');
            $this->db->where('is_parent', 'Y');
            $this->db->where('id_status', 1);
            $this->db->where_in('id_menu', $parentID);
            $this->db->order_by('id_menu ASC', 'order_menu ASC');
            $this->db->get();
            $query2 = $this->db->last_query();
            $query = $this->db->query("(" . $query1 . ") UNION (" . $query2 . ")");
        }

        return $query->result_array();
    }

    private function getMenuParent($parent)
    {
        $menus = "";
        $this->db->select('id_menu, parent_id');
        $this->db->from('xi_sa_menu');
        $this->db->where('id_menu', $parent);
        $this->db->where('is_parent', 'Y');
        $this->db->where('id_status', 1);
        $this->db->order_by('id_menu ASC', 'order_menu ASC');
        $query = $this->db->get();
        $menus .= $query->row()->id_menu . ',';
        if ($query->row()->parent_id != 0)
            $menus .= $this->getMenuParent($query->row()->parent_id);
        return $menus;
    }
}

// This is the end of auth signin model
