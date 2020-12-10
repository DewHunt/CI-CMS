<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->helper('file');
        $this->load->model('User_model');
        $this->load->model('Menu_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/index/') === false) {
            redirect(base_url('login'));
        } else {
            $allUsers = $this->User_model->get_all_users();

            $this->data['title'] = "User";
            $this->contentData['allUsers'] = $allUsers;

            $this->cardBodyContent = $this->load->view('admin/user/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/add/') === false) {
            redirect(base_url('login'));
        } else {
        	$allUserRoles = $this->Helper_model->get_all_data('tbl_user_roles','name','ASC');

            $this->data['title'] = "Add New User";
            $this->data['formLink'] = "user/save/";
            $this->data['buttonName'] = "Save";

            $this->contentData['allUserRoles'] = $allUserRoles;

            $this->cardBodyContent = $this->load->view('admin/user/add', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/add/') === false) {
            redirect(base_url('login'));
        } else {
            // echo "<pre>"; print_r($this->input->post()); exit();
            $userName = $this->input->post('username');
            $email = $this->input->post('email');

        	$isExists = $this->User_model->check_user_duplicity($userName,$email);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'User Name Or Email Already Exists.');
        		redirect(base_url('user/add'));
        	} else {
                $imagePath = $this->upload_image('userImage',500,'user/add','/public/uploads/user_images/');
                // echo "<pre>"; print_r($imagePath); exit();

                $data = array(
                    'name' => trim($this->input->post('name')),
                    'email' => $email,
                    'user_name' => $userName,
                    'image' => $imagePath,
                    'role' => trim($this->input->post('role')),
                    'password' => sha1(trim($this->input->post('password'))),
                );

                $this->db->insert('tbl_users', $data);
        		$this->session->set_flashdata('message', 'User Save Successfully.');
        		redirect(base_url('user'));
        	}
        }
    }

    public function edit($userId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/edit/') === false) {
            redirect(base_url('login'));
        } else {
            $userInfo = $this->Helper_model->get_data_by_id('tbl_users',$userId);
        	$allUserRoles = $this->Helper_model->get_all_data('tbl_user_roles','name','ASC');

            $this->data['title'] = "Edit User";
            $this->data['formLink'] = "user/update/";
            $this->data['buttonName'] = "Update";

            $this->contentData['userInfo'] = $userInfo;
            $this->contentData['allUserRoles'] = $allUserRoles;

            $this->cardBodyContent = $this->load->view('admin/user/edit', $this->contentData, TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/edit/') === true) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>"; print_r($this->input->post()); exit();

        	$id = $this->input->post('userId');
            $userName = $this->input->post('username');
            $email = $this->input->post('email');

        	$isExists = $this->User_model->check_user_duplicity_by_id($id,$userName,$email);

        	if ($isExists) {
        		$this->session->set_flashdata('error', 'User Name Or Email Already Exists.');
        		redirect(base_url('user/edit/'.$id));
        	} else {
                $userImage = $_FILES['userImage']['name'];

                if ($userImage) {
                    $imagePath = $this->upload_image('userImage',500,'user/edit/'.$id,'/public/uploads/user_images/');
                } else {
                    $imagePath = $this->input->post('previousUserImage');
                }

                $data = array(
                    'name' => trim($this->input->post('name')),
                    'email' => $email,
                    'user_name' => $userName,
                    'image' => $imagePath,
                    'role' => trim($this->input->post('role')),
                    'password' => sha1(trim($this->input->post('password'))),
                );

                $this->db->where('id',$id);
                $this->db->update('tbl_users', $data);
        		$this->session->set_flashdata('message', 'User Updated Successfully.');
        		redirect(base_url('user'));
        	}
        }
    }

    public function permission($userId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/permission/') === false) {
            redirect(base_url('login'));
        } else {
            $userMenus = $this->Menu_model->get_all_menu_info();
            $userInfo = $this->User_model->get_user_info_by_id($userId);
            $userRoles = $this->Helper_model->get_data_by_id('tbl_user_roles',$userInfo->role);

            // echo "<pre>"; print_r($userInfo); exit();

            $this->data['title'] = "User Menu Permission (".$userInfo->user_name.")";
            $this->data['formLink'] = "user/update_permission/";
            $this->data['buttonName'] = "Update";

            $this->contentData['userMenus'] = $userMenus;
            $this->contentData['userInfo'] = $userInfo;
            $this->contentData['userRoles'] = $userRoles;

            $this->customCss = $this->load->view('admin/user/css', '', TRUE);
            $this->cardBodyContent = $this->load->view('admin/user/permission', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/user/js', '', TRUE);
            
            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update_permission()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/permission/') === false) {
            redirect(base_url('login'));
        } else {
            // echo "<pre>"; print_r($this->input->post()); exit();

            $userRoleId = $this->input->post('userroleId');
            $userId = $this->input->post('userId');

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

            $this->db->where('id',$userId);
            $this->db->update('tbl_users', $data);
            $this->session->set_flashdata('message', 'User Menu Permission Updated Successfully.');
            redirect(base_url('user'));
        }
    }

    public function profile($userId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/profile/') === false) {
            redirect(base_url('login'));
        } else {
            $userInfo = $this->User_model->get_user_info_by_id($userId);
            // echo "<pre>"; print_r($userInfo); exit();

            $this->data['title'] = "User Profile";

            $this->contentData['title'] = "User Profile";
            $this->contentData['userInfo'] = $userInfo;
            // echo "<pre>"; print_r($this->contentData['data']); exit();

            // $this->customCss = $this->load->view('admin/user/css', '', TRUE);
            $this->cardContent = $this->load->view('admin/user/profile', $this->contentData, TRUE);

            $this->load->view('admin/master/master', $this->data);
        }
    }

    public function change_password($userId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/change_password/') === false) {
            redirect(base_url('login'));
        } else {
            $this->data['title'] = "Changer Password";
            $this->data['formLink'] = "user/update_password/";
            $this->data['buttonName'] = "Update";

            $this->contentData['userId'] = $userId;

            $this->cardBodyContent = $this->load->view('admin/user/change_password', $this->contentData, TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update_password()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/update_password/') === false) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('userId');
            $data = array(
                'password' => sha1(trim($this->input->post('password'))),
            );

            $this->db->where('id',$id);
            $this->db->update('tbl_users', $data);
            $this->session->set_flashdata('message', 'Password Updated Successfully.');
            redirect(base_url('user'));
        }
    }

    public function delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/delete/') === false) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete('tbl_users', array('id' => $id));
        }
    }

    public function status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || $this->Link_model->link_permission('user/status/') === false) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('id');
            $this->Helper_model->update_status('tbl_users',$id);
        }
    }
}
