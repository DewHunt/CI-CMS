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
}
