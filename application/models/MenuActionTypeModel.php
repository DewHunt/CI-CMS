<?php

defined('BASEPATH') OR exit('No direct script access allowed');

clASs MenuActionTypeModel extends CI_Model {
    public $table_name = 'tbl_menu_action_type';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function GetMaxAction()
    {
    	$maxActionId = $this->db->query("SELECT MAX(action_id) AS maxActionId FROM tbl_menu_action_type")->row();

    	return $maxActionId;
    }
}
