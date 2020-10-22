<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	protected $data = Array(); //protected variables goes here its declaration

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        // $this->load->helper('settings_helper');
        $this->load->model('HelperModel');
        
        if (empty($this->session->userdata('sessionUserInfo'))) {
            redirect(base_url('login'));
        }
    }

    public function Test()
    {
        echo "OK"; exit();
    }

    public function UploadImage($inputName,$maxSize,$link)
    {           
        if ((int) $_FILES['userImage']["size"] > ($maxSize * 1024)) {
            $this->session->set_flashdata('error', 'Image size can not be more than '.$maxSize.' KB');
            redirect(base_url($link));
        } else {
            $imagePath = ''; 
            $imageName = $_FILES[$inputName]['name'];
            // $imageSize = $_FILES[$inputName]["size"];
            $config['file_name'] = $imageName;
            $config['upload_path'] = './public/uploads/user_images/';
            $config['allowed_types'] = 'gif|jpg|png';
            // $config['max_size'] = $maxSize;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload($inputName)) {
                $imagePath  = '/public/uploads/user_images/' . $config['file_name'];
                return $imagePath;
            } else {
                $this->session->set_flashdata('error', 'Something Went Wrong. Please Try Again');
                redirect(base_url($link));
            }
        }
    }
}
