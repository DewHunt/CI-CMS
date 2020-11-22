<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Link_model extends CI_Model {


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function role_permission()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $userId = (int) $this->session->userdata('sessionUserInfo')->id;
    	$rolePermission = [];

        if ($roleId == 2) {
            $userMenuLists = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();           
        }
        else {
            $userMenuLists = $this->db->query("SELECT * FROM tbl_users WHERE id = $userId")->row();       	
        }

        if ($userMenuLists) {
            $rolePermission = explode(',', $userMenuLists->action_permission);
        }
        return $rolePermission;
    }

    public function menu_action()
    {
        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
    	
        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = '$menu->id' AND status = 1 ORDER BY order_by")->result();

        return $menuAction;
    }

    public function go_back_link()
    {
        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
        $dataLink = base_url($routeName);
        $dataLink = '<a class="btn btn-outline-info btn-lg" href="'.base_url($routeName).'"><i class="fa fa-arrow-circle-left"></i> Go Back</a>';
        
        return $dataLink;
    }

    public function link_permission($link = "")
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;        
        $rolePermission = $this->role_permission();
        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE action_link = '$link' AND status = 1")->row();
        $linkStatus = false;

        if (!empty($menuAction)) {
            if ($roleId == 2) {
                $linkStatus = true;
            } else {
                if (in_array($menuAction->id,$rolePermission)) {
                    $linkStatus = true;
                }                        
            }
        }
        return $linkStatus;
    }

    public function index_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $userId = (int) $this->session->userdata('sessionUserInfo')->id;
    	$rolePermission = [];

        if ($roleId == 2) {
            $userMenuLists = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();            
        } else {
            $userMenuLists = $this->db->query("SELECT * FROM tbl_users WHERE id = $userId")->row(); 
        }

        if ($userMenuLists) {
            $rolePermission = explode(',', $userMenuLists->permission);
        }

        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
        $dataLink = '';

        if (!empty($menu)) {
            if ($roleId == 2) {
                $dataLink = base_url($routeName);
            } else {
                if (in_array($menu->id,$rolePermission)) {
                    $dataLink = base_url($menu->menu_link);
                }                        
            }
        }
        
        return $dataLink;
    }

    public function add_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission();
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 1){
                        $dataLink = '<a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="'.base_url($action->action_link).'"><i class="fa fa-plus-circle"></i> '.$action->action_name.'</a>';
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function edit_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 2){
                        $dataLink = '<a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="'.base_url($action->action_link).'"><i class="fa fa-edit"></i> '.$action->action_name.'</a>';
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function delete_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 4){
                        $dataLink = base_url($action->action_link);
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function status_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 3){
                        $dataLink = base_url($action->action_link);
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function permission_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 5){
                        $dataLink = base_url($action->action_link);
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function view_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 8){
                        $dataLink = base_url($action->action_link);
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function change_password_link()
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 6){
                        $dataLink = $action->action_link;
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function action($id = null)
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission();
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    // Edit Option
                    if ($menuType == 2) {
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fas fa-edit text-inverse m-r-10"></i> </a>';
                    }

                    // Delete Option
                    if ($menuType == 4) {
                        $dataLink .= '<a id="cancel_'.$id.'" href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-trash text-danger"></i> </a>';
                    }


                    if ($menuType == 5) {
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" onclick="if (confirm(&quot;Are you sure you want to Permission ?&quot;)) { return true; } return false;"> <i class="fa fa-lock text-inverse m-r-10"></i> </a>';
                    }

                    if ($menuType == 6) {
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-key text-inverse m-r-10"></i> </a>';
                    }
                    
                    if($menuType == 7){
                        $dataLink .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                    }

                    if($menuType == 8){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                    }

                    if($menuType == 9){
                        $dataLink .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-shopping-bag text-danger m-r-10"></i> </a>';
                    }

                    if($menuType == 10){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-list text-success m-r-10"></i> </a>';
                    }
                    
                    if($menuType == 11){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" target="_blank" data-original-title="'.$action->action_name.'"> <i class="fa fa-print text-success m-r-10"></i> </a>';
                    }
                }
            }
        }
        
        return $dataLink;
    }

    public function status($id = null,$status = null)
    {
        $roleId = $this->session->userdata('sessionUserInfo')->role;
        $rolePermission = $this->role_permission($roleId);
        $menuAction = $this->menu_action();
        $dataLink = '';

        if (!empty($menuAction)) {
            foreach ($menuAction as $action) {
                $menuType = "";

                if ($roleId == 2) {
                    $menuType = $action->menu_type;
                } else {
                    if (in_array($action->id,$rolePermission)) {
                        $menuType = $action->menu_type;
                    }                        
                }

                if ($menuType != "") {
                    if($menuType == 3)
                    {
                        if($status == 1)
                        {
                            $checked = 'checked';
                        }
                        else
                        {
                            $checked = ''; 
                        }
                        $dataLink .= '<span class="switchery-demo m-b-30" onclick="statusChange('.$id.')">
                            <input type="checkbox"'.$checked.' class="js-switch" data-color="#00c292" data-switchery="true" style="display: none;" >
                            </span>';     
                    }
                }
            }
        }
        
        return $dataLink;
    }
}
