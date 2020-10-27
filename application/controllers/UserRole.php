<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserRole extends Admin_Controller {

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
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->IndexLink())) {
            redirect(base_url('login'));
        } else {
            $allUserRole = $this->HelperModel->GetAllData('tbl_user_roles','name','ASC');

            $this->data['title'] = "User Role";
            $this->contentData['allUserRole'] = $allUserRole;

            $this->cardBodyContent = $this->load->view('admin/user_role/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function Add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
            $this->data['title'] = "Add New User Role";
            $this->data['formLink'] = "userrole/save";
            $this->data['buttonName'] = "Save";

            $this->cardBodyContent = $this->load->view('admin/user_role/add', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function Save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
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
    }

    public function Edit($userRoleId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
            $userRoleInfo = $this->HelperModel->GetDataById('tbl_user_roles',$userRoleId);

            $this->data['title'] = "Edit User Role";
            $this->data['formLink'] = "userrole/update";
            $this->data['buttonName'] = "Update";

            $this->contentData['userRoleInfo'] = $userRoleInfo;

            $this->cardBodyContent = $this->load->view('admin/user_role/edit', $this->contentData, TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function Update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
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
    }

    public function Permission($userRoleId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->PermissionLink())) {
            redirect(base_url('login'));
        } else {
        	$userMenus = $this->MenuModel->GetAllMenuInfo();
        	$userRoles = $this->HelperModel->GetDataById('tbl_user_roles',$userRoleId);

        	// echo "<pre>"; print_r($userMenus); exit();

            $this->data['title'] = "User Permission";
            $this->data['formLink'] = "userrole/updatepermission/";
            $this->data['buttonName'] = "Update";

            $this->contentData['userMenus'] = $userMenus;
            $this->contentData['userRoles'] = $userRoles;

            $this->customCss = $this->load->view('admin/user_role/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/user_role/permission', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/user_role/js', '', TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function UpdatePermission()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->PermissionLink())) {
            redirect(base_url('login'));
        } else {
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
    }

    public function Delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->DeleteLink())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete('tbl_user_roles', array('id' => $id));
        }
    }

    public function Status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->StatusLink())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->HelperModel->UpdateStatus('tbl_user_roles',$id);
        }
    }
}