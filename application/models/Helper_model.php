<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Helper_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_data($tableName,$fieldName,$order)
    {
    	$results = $this->db->query("SELECT * FROM $tableName ORDER BY $fieldName $order")->result();

    	return $results;
    }

    public function get_data_by_id($tableName,$id)
    {
    	$results = $this->db->query("SELECT * FROM $tableName WHERE id = $id")->row();

    	return $results;
    }

    public function update_status($tableName,$id)
    {
    	$findResult = $this->db->query("SELECT * FROM $tableName WHERE id = $id")->row();

    	// echo "<pre>"; print_r($findResult); exit();

    	if ($findResult->status == 0) {
    		$status = 1;
    	} else {
    		$status = 0;
    	}

    	$update = $this->db->query("UPDATE $tableName SET status = $status WHERE id = $id");

    	if ($this->db->affected_rows() > 0)
    	{
    		return TRUE;
    	}
    	return FALSE;
    	
    }

    public function check_data_duplicity_by_field($tableName,$fieldName,$data)
    {
    	$isExists = $this->db->query("SELECT * FROM $tableName WHERE $fieldName = '$data'")->row();

    	return $isExists;
    }

    public function check_data_duplicity_by_field_and_id($tableName,$fieldName,$data,$id)
    {
    	$isExists = $this->db->query("SELECT * FROM $tableName WHERE $fieldName = '$data' AND id <> $id")->row();

    	return $isExists;
    }

    public function get_all_menus($id)
    {
    	$result = $this->db->query("SELECT * FROM tbl_menus WHERE parent_menu = $id")->result();

    	return $result;
    }

    public function get_user_menu_action_count($id)
    {
    	$count = $this->db->query("SELECT COUNT(*) AS count FROM tbl_menu_actions WHERE parent_menu_id = $id AND status = 1")->row();

    	return $count;
    }

    public function get_user_menu_action($id)
    {
    	$result = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $id AND status = 1 ORDER BY order_by ASC")->result();

    	return $result;
    }

    public function get_data_by_multiple_id($tableName,$ids)
    {
    	$result = $this->db->query("SELECT * FROM $tableName WHERE id IN ($ids)")->result();

    	return $result;
    }
}