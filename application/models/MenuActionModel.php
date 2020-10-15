<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MenuActionModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function action($id = null)
    {
        $roleId = $this->session->userdata('sessionUserInfo')['role'];
        $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();

        if ($userRole)
        {
	        $rolePermission = explode(',', $userRole->action_permission);
	        $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
	        $menu = $this->db->query("SELECT * FROM tbl_menus WHERE menu_link = '$routeName'")->row();
	        $menuAction = $this->db->query("SELECT * FROM tbl_menu_actions WHERE parent_menu_id = $menu->id AND status = 1")->result();
	        $data_link = '';

            if (!empty($MenuAction)) {
                foreach ($MenuAction as $action) {
                    if (in_array($action->id, $rolePermission)) {
                        // Edit Option
                        if($action->menu_type == 2){
                        	$data_link .= '<a href="'.base_url($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fas fa-edit text-inverse m-r-10"></i> </a>';
                        }

                        if($action->menu_type == 7){
                        	$data_link .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                        }

                        if($action->menu_type == 8){
                        	$data_link .= '<a href="'.base_url($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-eye text-success m-r-10"></i> </a>';
                        }

                        // Delete Option
                        if($action->menu_type == 4){
                        	$data_link .= '<a id="cancel_'.$id.'" href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"  data-token="{{ csrf_token() }}"> <i class="fa fa-trash text-danger"></i> </a>';
                        }

                        if($action->menu_type == 5){
                        	$data_link .= '<a href="'.base_url($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'" onclick="if (confirm(&quot;Are you sure you want to Permission ?&quot;)) { return true; } return false;"> <i class="fa fa-lock text-inverse m-r-10"></i> </a>';
                        }

                        if($action->menu_type == 6){
                        	$data_link .= '<a href="'.base_url($action->action_link,[$id,2]).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-key text-inverse m-r-10"></i> </a>';
                        }

                        if($action->menu_type == 9){
                        	$data_link .= '<a href="javascript:void(0)" data-toggle="tooltip" data-original-title="'.$action->action_name.'" data-id="'.$id.'"> <i class="fa fa-shopping-bag text-danger m-r-10"></i> 
                            </a>';
                        }

                        if($action->menu_type == 10){
                        	$data_link .= '<a href="'.base_url($action->action_link,$id).'" data-toggle="tooltip" data-original-title="'.$action->action_name.'"> <i class="fa fa-list text-success m-r-10"></i> </a>';
                        }
                        
                        if($action->menu_type == 11){
                        	$data_link .= '<a href="'.base_url($action->action_link,$id).'" data-toggle="tooltip" target="_blank" data-original-title="'.$action->action_name.'"> <i class="fa fa-print text-success m-r-10"></i> </a>';
                        }
                    }
                }
            }
        }
        
        return $data_link;
    }
}
