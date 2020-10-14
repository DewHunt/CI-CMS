<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        // $this->load->model('Company_Model');
        // $this->load->model('User_Model');
        // $this->load->model('Login_log_details_Model');
        // $this->load->model('Notification_Model');
        // $this->load->model('Notification_assign_Model');
        // $this->load->model('Weekend_settings_Model');
        // $this->load->model('Calendar_Model');
        // $this->load->model('Events_Model');
        // $this->load->model('Product_Model');
        // $this->load->model('Product_reorder_level_Model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index() {
        $this->data['title'] = "Menu";
        $this->data['addButtonLink'] = "menu/add";

        $roleId = $this->session->userdata('sessionUserInfo')['role'];
        $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();

        $rolePermission = explode(',', $userRole->action_permission);
        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $menu->id AND status = 1")->result();

        if (!empty($menuAction)) {
        	foreach ($menuAction as $action) {
        		if (in_array($action->id,$rolePermission)) {
        			echo "Role Permission = ".$action->id."<br>";
        			echo "Menu Action Type = ".$action->menu_type."<br>--------------<br>";
        		}
        	}
        }

        echo "<pre>";
        // print_r($menuAction);
        exit();

        // $this->load->view('header');
        // $this->load->view('navigation');
        $this->load->view('admin/menu/index', $this->data);
    }

    public function add() {
    	echo "Dew Hunt";
    }
}
