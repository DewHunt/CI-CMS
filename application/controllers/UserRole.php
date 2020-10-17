<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserRole extends CI_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        $this->load->model('UserRoleModel');
        $this->load->model('MenuModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Index()
    {
        $allUserRole = $this->HelperModel->GetAllData('tbl_user_roles','name','ASC');

        $this->data['title'] = "Menu";
        $this->data['addButtonLink'] = "userrole/add/";
        $this->data['deleteLink'] = "userrole/delete";
        $this->data['statusLink'] = "userrole/status/";
        $this->data['allUserRole'] = $allUserRole;

        $this->load->view('admin/user_role/index', $this->data);
    }

    public function Add()
    {
        $menus = $this->MenuModel->GetAllMenuInfo();

        $parentMenuMaxOrder = $this->MenuModel->GetParentMenuMaxOrder();

        if ($parentMenuMaxOrder) {
        	$orderBy = $parentMenuMaxOrder->maxOrder + 1;
        } else {
        	$orderBy = 1;
        }

        $this->data['title'] = "Add New Menu";
        $this->data['formLink'] = "menu/save";
        $this->data['buttonName'] = "Save";
        $this->data['goBackLink'] = "menu";
        $this->data['menus'] = $menus;
        $this->data['orderBy'] = $orderBy;

        $this->load->view('admin/menu/add', $this->data);
    }

    public function Save()
    {
    	// echo "<pre>";
    	// print_r($this->input->post()); exit();

    	$menuLink = $this->input->post('menuLink');

    	if ($menuLink == "") {
    		$isExists = "";
    	} else {
    		$isExists = $this->HelperModel->CheckDataDuplicityByField('tbl_menus','menu_link',$menuLink);
    	}    	

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Link Already Exists.');
    		redirect(base_url('menu/add'));
    	} else {
	    	$orderBy = $this->input->post('orderBy');

            $data = array(
                'parent_menu' => trim($this->input->post('parentMenu')),
                'menu_name' => trim($this->input->post('menuName')),
                'menu_link' => $menuLink,
                'menu_icon' => trim($this->input->post('menuIcon')),
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->insert('tbl_menus', $data);
    		$this->session->set_flashdata('message', 'Menu Save Successfully.');
    		redirect(base_url('menu'));
    	}
    }

    public function Edit($menuId)
    {
        $menus = $this->MenuModel->GetAllMenuInfo();
        $menuInfo = $this->MenuModel->GetMenuInfoById($menuId);

        $this->data['title'] = "Edit Menu";
        $this->data['formLink'] = "menu/update";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "menu";
        $this->data['menus'] = $menus;
        $this->data['menuInfo'] = $menuInfo;

        $this->load->view('admin/menu/edit', $this->data);
    }

    public function Update()
    {
    	// echo "<pre>";
    	// print_r($this->input->post()); exit();

    	$menuLink = $this->input->post('menuLink');
    	$id = $this->input->post('menuId');

    	if ($menuLink == "") {
    		$isExists == "";
    	} else {
    		$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId('tbl_menus','menu_link',$menuLink,$id);
    	}    	

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'Menu Link Already Exists.');
    		redirect(base_url('menu/edit/'.$id));
    	} else {
    		if ($this->input->post('parentMenu') == "") {
    			$parentMenu = NULL;
    		} else {
    			$parentMenu = $this->input->post('parentMenu');
    		}
    		

            $data = array(
                'parent_menu' => $parentMenu,
                'menu_name' => trim($this->input->post('menuName')),
                'menu_link' => $menuLink,
                'menu_icon' => trim($this->input->post('menuIcon')),
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->where('id',$id);
            $this->db->update('tbl_menus', $data);
    		$this->session->set_flashdata('message', 'Menu Updated Successfully.');
    		redirect(base_url('menu'));
    	}
    }

    public function Permission($userRoleId)
    {
    	$userMenus = $this->MenuModel->GetAllMenuInfo();
    	$userRoles = $this->HelperModel->GetDataById('tbl_user_roles',$userRoleId);

    	// echo "<pre>"; print_r($userRoles); exit();

        $this->data['title'] = "User Permission";
        $this->data['formLink'] = "userrole/updatepermission/";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "userrole/";
        $this->data['userMenus'] = $userMenus;
        $this->data['userRoles'] = $userRoles;

        $this->load->view('admin/user_role/permission', $this->data);
    }

    public function Delete()
    {
    	$id = $this->input->post('id');
    	$this->db->delete('tbl_user_roles', array('id' => $id));
    }

    public function Status()
    {
    	$id = $this->input->post('id');
    	$this->HelperModel->UpdateStatus('tbl_user_roles',$id);
    }
}