<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserRoleModel extends CI_Model {
    public $table_name = 'tbl_user_roles';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function GetUserRoleInfoById($menuId)
    {
    	$menuInfo = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $menuId")->row();

    	return $menuInfo;
    }
}
