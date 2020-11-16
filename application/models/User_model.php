<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public $table_name = 'tbl_users';
    protected $primary_key = 'id';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_users()
    {
        $allUsers = $this->db->query("
            SELECT `tbl_users`.*, `tbl_user_roles` .`name` AS `roleName` 
            FROM tbl_users
            LEFT JOIN `tbl_user_roles` ON `tbl_user_roles`.`id` = `tbl_users`.`role`
        ")->result();

        return $allUsers;
    }

    public function get_user_info_by_id($userId)
    {
        $result = $this->db->query("
            SELECT `tbl_users`.*, `tbl_user_roles`.`name` AS `userRoleName` 
            FROM `tbl_users` 
            LEFT JOIN `tbl_user_roles` ON `tbl_user_roles`.`id` = `tbl_users`.`role`
            WHERE `tbl_users`.`id` = $userId"
        )->row();

        return $result;
    }

    public function get_user_info_by_user_name_or_email_and_password($userNameOrEmail,$password)
    {
    	$result = $this->db->query("SELECT * FROM tbl_users WHERE (user_name = '$userNameOrEmail' OR email = '$userNameOrEmail') AND password = '$password'")->row();

    	return $result;
    }

    public function check_user_duplicity($userName,$email)
    {
        $result = $this->db->query("SELECT * FROM tbl_users WHERE email = '$email' OR user_name = '$userName'")->row();

        return $result;
    }

    public function check_user_duplicity_by_id($id,$userName,$email)
    {
        $result = $this->db->query("SELECT * FROM tbl_users WHERE (email = '$email' OR user_name = '$userName') AND id <> $id")->row();

        return $result;
    }
}
