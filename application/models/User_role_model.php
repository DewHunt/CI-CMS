<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_role_model extends CI_Model {
    public $table_name = 'tbl_user_roles';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function get_user_role_info_by_id($menuId)
    {
    	$menuInfo = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $menuId")->row();

    	return $menuInfo;
    }
}
