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

        $this->data['title'] = "User Role";
        $this->data['allUserRole'] = $allUserRole;

        $this->load->view('admin/user_role/index', $this->data);
    }

    public function Add()
    {
        $this->data['title'] = "Add New User Role";
        $this->data['formLink'] = "userrole/save";
        $this->data['buttonName'] = "Save";
        $this->data['goBackLink'] = "userrole";

        $this->load->view('admin/user_role/add', $this->data);
    }

    public function Save()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$name = $this->input->post('name');

    	$isExists = $this->HelperModel->CheckDataDuplicityByField('tbl_user_roles','name',$name);   	

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'User Role Already Exists.');
    		redirect(base_url('userrole/add'));
    	} else {
	    	$orderBy = $this->input->post('orderBy');

            $data = array(
                'name' => $name,
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->insert('tbl_user_roles', $data);
    		$this->session->set_flashdata('message', 'User Role Created Successfully.');
    		redirect(base_url('userrole'));
    	}
    }

    public function Edit($userRoleId)
    {
        $userRoleInfo = $this->HelperModel->GetDataById('tbl_user_roles',$userRoleId);

        $this->data['title'] = "Edit User Role";
        $this->data['formLink'] = "userrole/update";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "userrole";
        $this->data['userRoleInfo'] = $userRoleInfo;

        $this->load->view('admin/user_role/edit', $this->data);
    }

    public function Update()
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$name = $this->input->post('name');
    	$userRoleId = $this->input->post('userRoleId');

    	$isExists = $this->HelperModel->CheckDataDuplicityByFieldAndId('tbl_user_roles','name',$name,$userRoleId);   	

    	if ($isExists) {
    		$this->session->set_flashdata('error', 'User Role Already Exists.');
    		redirect(base_url('userrole/edit/'.$userRoleId));
    	} else {
	    	$orderBy = $this->input->post('orderBy');

            $data = array(
                'name' => $name,
                'order_by' => trim($this->input->post('orderBy')),
            );

            $this->db->where('id',$userRoleId);
            $this->db->update('tbl_user_roles', $data);
    		$this->session->set_flashdata('message', 'User Role Updated Successfully.');
    		redirect(base_url('userrole'));
    	}
    }

    public function Permission($userRoleId)
    {
    	$userMenus = $this->MenuModel->GetAllMenuInfo();
    	$userRoles = $this->HelperModel->GetDataById('tbl_user_roles',$userRoleId);

    	// echo "<pre>"; print_r($userMenus); exit();

        $this->data['title'] = "User Permission";
        $this->data['formLink'] = "userrole/updatepermission/";
        $this->data['buttonName'] = "Update";
        $this->data['goBackLink'] = "userrole/";
        $this->data['userMenus'] = $userMenus;
        $this->data['userRoles'] = $userRoles;

        $this->load->view('admin/user_role/permission', $this->data);
    }

    public function UpdatePermission($value='')
    {
    	// echo "<pre>"; print_r($this->input->post()); exit();

    	$userRoleId = $this->input->post('userroleId');

		if ($this->input->post('usermenu') == "") {
			$userMenus = NULL;
		} else {
			$userMenus = implode(',',$this->input->post('usermenu'));
		}

		if ($this->input->post('usermenuAction') == "") {
			$userMenuActions = NULL;
		} else {
			$userMenuActions = implode(',',$this->input->post('usermenuAction'));
		}
		

        $data = array(
            'permission' => $userMenus,                     
            'action_permission' => $userMenuActions, 
        );

        $this->db->where('id',$userRoleId);
        $this->db->update('tbl_user_roles', $data);
		$this->session->set_flashdata('message', 'User Role Permission Updated Successfully.');
		redirect(base_url('userrole'));
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