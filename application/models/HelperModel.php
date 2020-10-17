<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class HelperModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function GetAllData($tableName,$fieldName,$order) {
    	$results = $this->db->query("SELECT * FROM $tableName ORDER BY $fieldName $order")->result();

    	return $results;
    }

    public function GetDataById($tableName,$id) {
    	$results = $this->db->query("SELECT * FROM $tableName WHERE id = $id")->row();

    	return $results;
    }

    public function UpdateStatus($tableName,$id)
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

    public function CheckDataDuplicityByField($tableName,$fieldName,$data)
    {
    	$isExists = $this->db->query("SELECT * FROM $tableName WHERE $fieldName = '$data'")->row();

    	return $isExists;
    }

    public function CheckDataDuplicityByFieldAndId($tableName,$fieldName,$data,$id)
    {
    	$isExists = $this->db->query("SELECT * FROM $tableName WHERE $fieldName = '$data' AND id <> $id")->row();

    	return $isExists;
    }

    public function GetAllMenus($id)
    {
    	$result = $this->db->query("SELECT * FROM tbl_menus WHERE parent_menu = $id")->result();

    	return $result;
    }

    public function GetUserMenuActionCount($id)
    {
    	$count = $this->db->query("SELECT COUNT(*) AS count FROM tbl_menu_actions WHERE parent_menu_id = $id AND status = 1")->row();

    	return $count;
    }

    public function GetUserMenuAction($id)
    {
    	$result = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $id AND status = 1 ORDER BY order_by ASC")->result();

    	return $result;
    }

    public function GetDataByMultipleId($tableName,$ids)
    {
    	$result = $this->db->query("SELECT * FROM $tableName WHERE id IN ($ids)")->result();

    	return $result;
    }
}