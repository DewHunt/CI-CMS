<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LinkModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function action($id = null)
    {
        $roleId = $this->session->userdata('sessionUserInfo')['role'];

        if ($roleId != 2) {
            $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();

            if ($userRole) {
                $rolePermission = explode(',', $userRole->action_permission);
            } else {
                $rolePermission = [];
            }            
        }

        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $menu->id AND status = 1")->result();
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
                    if($menuType == 2){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fas fa-edit text-inverse m-r-10"></i> </a>';
                    }

                    if($menuType == 7){
                        $dataLink .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                    }

                    if($menuType == 8){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                    }

                    // Delete Option
                    if($menuType == 4){
                        $dataLink .= '<a id="cancel_'.$id.'" href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"  data-token="{{ csrf_token() }}"> <i class="fa fa-trash text-danger"></i> </a>';
                    }

                    if($menuType == 5){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" onclick="if (confirm(&quot;Are you sure you want to Permission ?&quot;)) { return true; } return false;"> <i class="fa fa-lock text-inverse m-r-10"></i> </a>';
                    }

                    if($menuType == 6){
                        $dataLink .= '<a href="'.base_url("{$action->action_link}{$id}").'/2" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-key text-inverse m-r-10"></i> </a>';
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
        $roleId = $this->session->userdata('sessionUserInfo')['role'];

        if ($roleId != 2) {
            $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();

            if ($userRole) {
                $rolePermission = explode(',', $userRole->action_permission);
            } else {
                $rolePermission = [];
            }            
        }

        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $menu->id AND status = 1")->result();
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
