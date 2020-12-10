<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Admin_Controller {

    public function __construct()
    {
        parent:: __construct();
        $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('Menu_model');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/index/'))) {
            redirect(base_url('login'));
        } else {
            $menus = $this->Menu_model->get_all_menu_list();

            $this->data['title'] = "Menu";
            $this->contentData['menus'] = $menus;

            $this->cardBodyContent = $this->load->view('admin/menu/index', $this->contentData, TRUE);

            $this->load->view('admin/master/master_index', $this->data);
        }        
    }

    public function add()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/add/'))) {
            redirect(base_url('login'));
        } else {
            // echo $this->Link_model->AddLink(); exit();
            $menus = $this->Menu_model->get_all_menu_info();

            $parentMenuMaxOrder = $this->Menu_model->get_parent_menu_max_order();

            if ($parentMenuMaxOrder) {
                $orderBy = $parentMenuMaxOrder->maxOrder + 1;
            } else {
                $orderBy = 1;
            }

            $this->data['title'] = "Add New Menu";
            $this->data['formLink'] = "menu/save/";
            $this->data['buttonName'] = "Save";

            $this->contentData['menus'] = $menus;
            $this->contentData['orderBy'] = $orderBy;

            $this->cardBodyContent = $this->load->view('admin/menu/add', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/menu/js', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function save()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/add/'))) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$menuLink = $this->input->post('menuLink');

        	if ($menuLink == "") {
        		$isExists = "";
        	} else {
        		$isExists = $this->Helper_model->check_data_duplicity_by_field('tbl_menus','menu_link',$menuLink);
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

    public function edit($menuId)
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/edit/'))) {
            redirect(base_url('login'));
        } else {
            $menus = $this->Menu_model->get_all_menu_info();
            $menuInfo = $this->Menu_model->get_menu_info_by_id($menuId);

            $this->data['title'] = "Edit Menu";
            $this->data['formLink'] = "menu/update/";
            $this->data['buttonName'] = "Update";

            $this->contentData['menus'] = $menus;
            $this->contentData['menuInfo'] = $menuInfo;

            $this->cardBodyContent = $this->load->view('admin/menu/edit', $this->contentData, TRUE);
            $this->customJs = $this->load->view('admin/menu/js', '', TRUE);

            $this->load->view('admin/master/master_add_edit', $this->data);
        }
    }

    public function update()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/edit/'))) {
            redirect(base_url('login'));
        } else {
        	// echo "<pre>";
        	// print_r($this->input->post()); exit();

        	$menuLink = $this->input->post('menuLink');
        	$id = $this->input->post('menuId');

        	if ($menuLink == "") {
        		$isExists == "";
        	} else {
        		$isExists = $this->Helper_model->check_data_duplicity_by_field_and_id('tbl_menus','menu_link',$menuLink,$id);
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

    public function delete()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/delete/'))) {
            redirect(base_url('login'));
        } else {
        	$id = $this->input->post('id');
        	$this->db->delete('tbl_menus', array('id' => $id));
        	$this->db->delete('tbl_menu_actions', array('parent_menu_id' => $id));
        }
    }

    public function status()
    {
        if (empty($this->session->userdata('sessionUserInfo')) || empty($this->Link_model->link_permission('menu/status/'))) {
            redirect(base_url('login'));
        } else {
            $id = $this->input->post('id');
            $this->Helper_model->update_status('tbl_menus',$id);
        }
    }

    public function max_order()
    {
    	$parentMenuId = $this->input->post('parentMenuId');

    	if ($parentMenuId != "") {
            $menuMaxOrder = $this->Menu_model->GetMaxOrder($parentMenuId);
    	} else {
        	$menuMaxOrder = $this->Menu_model->GetParentMenuMaxOrder();
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
