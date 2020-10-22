<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
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
            $menus = $this->MenuModel->GetAllMenuList();

            $this->data['title'] = "Menu";
            $this->data['menus'] = $menus;

            $this->load->view('admin/menu/index', $this->data);
        }        
    }

    public function Add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
            // echo $this->LinkModel->AddLink(); exit();
            $menus = $this->MenuModel->GetAllMenuInfo();

            $parentMenuMaxOrder = $this->MenuModel->GetParentMenuMaxOrder();

            if ($parentMenuMaxOrder) {
                $orderBy = $parentMenuMaxOrder->maxOrder + 1;
            } else {
                $orderBy = 1;
            }

            $this->data['title'] = "Add New Menu";
            $this->data['formLink'] = "menu/save/";
            $this->data['buttonName'] = "Save";
            $this->data['menus'] = $menus;
            $this->data['orderBy'] = $orderBy;

            $this->load->view('admin/menu/add', $this->data);
        }
    }

    public function Save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->AddLink())) {
            redirect(base_url('login'));
        } else {
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

                $this->db->insert('tbl_menus', $data);
        		$this->session->set_flashdata('message', 'Menu Save Successfully.');
        		redirect(base_url('menu'));
        	}
        }
    }

    public function Edit($menuId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
            $menus = $this->MenuModel->GetAllMenuInfo();
            $menuInfo = $this->MenuModel->GetMenuInfoById($menuId);

            $this->data['title'] = "Edit Menu";
            $this->data['formLink'] = "menu/update/";
            $this->data['buttonName'] = "Update";
            $this->data['menus'] = $menus;
            $this->data['menuInfo'] = $menuInfo;

            $this->load->view('admin/menu/edit', $this->data);
        }
    }

    public function Update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->EditLink())) {
            redirect(base_url('login'));
        } else {
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
    }

    public function Delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->DeleteLink())) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete('tbl_menus', array('id' => $id));
        	$this->db->delete('tbl_menu_actions', array('parent_menu_id' => $id));
        }
    }

    public function Status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->LinkModel->StatusLink())) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('id');
            $this->HelperModel->UpdateStatus('tbl_menus',$id);
        }
    }

    public function MaxOrder()
    {
    	$parentMenuId = $this->input->post('parentMenuId');

    	if ($parentMenuId != "") {
            $menuMaxOrder = $this->MenuModel->GetMaxOrder($parentMenuId);
    	} else {
        	$menuMaxOrder = $this->MenuModel->GetParentMenuMaxOrder();
    	}

        if ($menuMaxOrder) {
            $orderBy = $menuMaxOrder->maxOrder + 1;
        }
        else {
            $orderBy = 1;
        }

        $this->output->set_content_type('application/json')->set_output(json_encode(array(
            'orderBy' => $orderBy,
        )));   
    }
}
