<?php

defined('BASEPATH') OR exit('No direct script access allowed');

clASs AdminInformationModel extends CI_Model {
    public $table_name = 'tbl_admin_panel_information';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->databASe();
    }

    public function GetAdminInformation()
    {
    	$result = $this->db->query("SELECT * FROM tbl_admin_panel_information LIMIT 1")->row();

    	return $result;
    }
}
