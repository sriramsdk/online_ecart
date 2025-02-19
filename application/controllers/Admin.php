<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Admin side controller
class Admin extends CI_Controller {

    // index function
    public function index(){

        if (!$this->session->userdata('admin_logged_in')) {
            redirect('Admin/Login');
        }

        $this->load->view('Admin/layouts/Header');
        $this->load->view('Admin/Admin_dashboard');
        $this->load->view('Admin/layouts/Footer');
    }

    // login page function
    public function Login(){
        if($this->session->userdata('admin_logged_in')){
            redirect('Admin');
        }

        $this->load->view('Admin/Login');
    }

    // Process login
    public function login_process(){
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admin_username = env('ADMIN_USERNAME');
        $admin_password = env('ADMIN_PASSWORD');

        // echo "<pre>";print_r($admin_username);exit();

        if($username === $admin_username && $password === $admin_password){

            // Set session
            $this->session->set_userdata('admin_logged_in', true);
            redirect('Admin');

        }else{
            $this->session->set_flashdata('error','Invalid Username or Password');
            redirect('Admin/Login');
        }
    }

    // Logout
    public function logout() {
        $this->session->unset_userdata('admin_logged_in');
        redirect('admin/login');
    }

    public function add_product(){
        echo "<pre>";print_r($_POST);exit();
    }

}

?>