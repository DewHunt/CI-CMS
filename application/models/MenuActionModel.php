<?php

defined('BASEPATH') OR exit('No direct script access allowed');

clASs MenuActionModel extends CI_Model {
    public $table_name = 'tbl_menu_actions';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function GetUserMenuActionCount($id)
    {
    	$count = $this->db->query("SELECT COUNT(*) FROM tbl_menu_actions WHERE parent_menu_id = $id AND status = 1")->get();

    	return $count;
    }
}
