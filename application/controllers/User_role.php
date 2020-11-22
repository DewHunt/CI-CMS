<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_role extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        $this->load->model('User_role_model');
        $this->load->model('Menu_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {        
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->index_link())) {
            redirect(base_url('login'));
        } else {
            $allUserRole = $this->Helper_model->get_all_data('tbl_user_roles','name','ASC');

            $this->data['title'] = "User Role";
            $this->contentData['allUserRole'] = $allUserRole;

            $this->cardBodyContent = $this->load->view('admin/user_role/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->add_link())) {
            redirect(base_url('login'));
        } else {
            $this->data['title'] = "Add New User Role";
            $this->data['formLink'] = "user_role/save";
            $this->data['buttonName'] = "Save";

            $this->cardBodyContent = $this->load->view('admin/user_role/add', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->add_link())) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>"; print_r($this->input->post()); exit();

        	$name = $this->input->post('name');

        	$isExists = $this->Helper_model->check_data_duplicity_by_field('tbl_user_roles','name',$name);   	

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'User Role Already Exists.');
        		redirect(base_url('user_role/add'));
        	} else {
    	    	$orderBy = $this->input->post('orderBy');

                $data = array(
                    'name' => $name,
                    'order_by' => trim($this->input->post('orderBy')),
                );

                $this->db->insert('tbl_user_roles', $data);
        		$this->session->set_flashdata('message', 'User Role Created Successfully.');
        		redirect(base_url('user_role'));
        	}
        }
    }

    public function edit($userRoleId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->edit_link())) {
            redirect(base_url('login'));
        } else {
            $userRoleInfo = $this->Helper_model->get_data_by_id('tbl_user_roles',$userRoleId);

            $this->data['title'] = "Edit User Role";
            $this->data['formLink'] = "user_role/update";
            $this->data['buttonName'] = "Update";

            $this->contentData['userRoleInfo'] = $userRoleInfo;

            $this->cardBodyContent = $this->load->view('admin/user_role/edit', $this->contentData, TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->edit_link())) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>"; print_r($this->input->post()); exit();

        	$name = $this->input->post('name');
        	$userRoleId = $this->input->post('userRoleId');

        	$isExists = $this->Helper_model->check_data_duplicity_by_field_and_id('tbl_user_roles','name',$name,$userRoleId);   	

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'User Role Already Exists.');
        		redirect(base_url('user_role/edit/'.$userRoleId));
        	} else {
    	    	$orderBy = $this->input->post('orderBy');

                $data = array(
                    'name' => $name,
                    'order_by' => trim($this->input->post('orderBy')),
                );

                $this->db->where('id',$userRoleId);
                $this->db->update('tbl_user_roles', $data);
        		$this->session->set_flashdata('message', 'User Role Updated Successfully.');
        		redirect(base_url('user_role'));
        	}
        }
    }

    public function permission($userRoleId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->permission_link())) {
            redirect(base_url('login'));
        } else {
        	$userMenus = $this->Menu_model->get_all_menu_info();
        	$userRoles = $this->Helper_model->get_data_by_id('tbl_user_roles',$userRoleId);

        	// echo "<pre>"; print_r($userRoles); exit();

            $this->data['title'] = "User Role Menu Permission (".$userRoles->name.")";
            $this->data['formLink'] = "user_role/update_permission/";
            $this->data['buttonName'] = "Update";

            $this->contentData['userMenus'] = $userMenus;
            $this->contentData['userRoles'] = $userRoles;

            $this->customCss = $this->load->view('admin/user_role/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/user_role/permission', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/user_role/js', '', TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update_permission()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->permission_link())) {
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
    		$this->session->set_flashdata('message', 'User Role Menu Permission Updated Successfully.');
    		redirect(base_url('user_role'));
        }
    }

    public function delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->delete_link())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete('tbl_user_roles', array('id' => $id));
        }
    }

    public function status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->status_link())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->Helper_model->update_status('tbl_user_roles',$id);
        }
    }
}