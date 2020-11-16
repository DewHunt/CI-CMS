<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {
    public $table_name = 'tbl_menus';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function get_all_menu_list()
    {
    	$allMenuList = $this->db->query("
    		(SELECT `tab1`.*, `tab2`.`menu_name` AS `parentName` 
    		FROM `tbl_menus` AS `tab1` 
    		INNER JOIN `tbl_menus` AS `tab2` ON `tab2`.`id` = `tab1`.`parent_menu`) 
    		UNION (SELECT `tbl_menus`.*, `parent_menu` AS `parentName` FROM `tbl_menus` WHERE `tbl_menus`.`parent_menu` is NULL) 
    		ORDER BY `parentName` ASC, `order_by` ASC
    	")->result();

    	return $allMenuList;
    }

    public function get_all_menu_info()
    {
    	$allMenuInfo = $this->db->query("SELECT * FROM tbl_menus WHERE status = 1 ORDER BY menu_name ASC")->result();

    	return $allMenuInfo;
    }

    public function get_menu_info_by_id($menuId)
    {
    	$menuInfo = $this->db->query("SELECT * FROM tbl_menus WHERE id = $menuId")->row();

    	return $menuInfo;
    }

    public function get_parent_menu_max_order()
    {
    	$maxOrder = $this->db->query("SELECT MAX(order_by) AS maxOrder FROM tbl_menus WHERE parent_menu IS NULL")->row();

    	return $maxOrder;
    }

    public function GetMaxOrder($parentMenuId)
    {
    	$maxOrder = $this->db->query("SELECT MAX(order_by) AS maxOrder FROM tbl_menus WHERE parent_menu = $parentMenuId")->row();

    	return $maxOrder;
    }
}
