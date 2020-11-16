<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_action_type_model extends CI_Model {
    public $table_name = 'tbl_menu_action_type';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function get_max_action()
    {
    	$maxActionId = $this->db->query("SELECT MAX(action_id) AS maxActionId FROM tbl_menu_action_type")->row();

    	return $maxActionId;
    }
}
