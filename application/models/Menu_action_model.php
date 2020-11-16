<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_action_model extends CI_Model {
    public $table_name = 'tbl_menu_actions';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function get_menu_action_list_by_menu_id($menuId)
    {
        $result = $this->db->query("
            SELECT `tbl_menu_actions`.*, `tbl_menus`.`menu_name` AS `parentMenuName`, `tbl_menu_action_type`.`name` AS `actionTypeName` 
            FROM `tbl_menu_actions` 
            LEFT JOIN `tbl_menus` ON `tbl_menus`.`id` = `tbl_menu_actions`.`parent_menu_id`
            LEFT JOIN `tbl_menu_action_type` ON `tbl_menu_action_type`.`action_id` = `tbl_menu_actions`.`menu_type`
            WHERE `tbl_menu_actions`.`parent_menu_id` = $menuId
            ORDER BY `tbl_menu_actions`.`order_by` asc
        ")->result();

        return $result;
    }

    public function get_menu_action_max_order($menuId)
    {
        $maxOrder = $this->db->query("SELECT MAX(order_by) AS maxOrder FROM tbl_menu_actions WHERE parent_menu_id = $menuId")->row();

        return $maxOrder;
    }
}
