<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public $table_name = 'tbl_users';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function GetAllUsers()
    {
        $allUsers = $this->db->query("
            SELECT `tbl_users`.*, `tbl_user_roles` .`name` AS `roleName` 
            FROM tbl_users
            LEFT JOIN `tbl_user_roles` ON `tbl_user_roles`.`id` = `tbl_users`.`role`
        ")->result();

        return $allUsers;
    }

    public function getUserInfoByUserNameOrEmailAndPassword($userNameOrEmail,$password)
    {
    	$result = $this->db->query("SELECT * FROM tbl_users WHERE (user_name = '$userNameOrEmail' OR email = '$userNameOrEmail') AND password = '$password'")->row();

    	return $result;
    }    
}
