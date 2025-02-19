<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Admin side controller
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_Model');
    }

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

        $upload_path = "./uploads/products/";

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = "jpg|jpeg|png|gif";
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('product_image')) {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'failed', 'message' => 'Failed to upload image']);
        } else {
            $upload_data = $this->upload->data();
            $image_path = 'uploads/products/' . $upload_data['file_name'];

            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_discount = $this->input->post('product_discount');
            $final_price = $this->input->post('product_final_price');
            $company = $this->input->post('company');
            $category = $this->input->post('category');

            $product_data = array(
                'product_name' => $product_name,
                'product_price' => $product_price,
                'discount' => $product_discount,
                'product_discount' => $final_price,
                'product_image' => $image_path,
                'company' => $company,
                'category' => $image_path
            );

            $response = $this->Product_Model->insert_product($product_data);

            if($response){
                echo json_encode(['status' => 'success', 'message' => "Product added successfully"]);
            }else{
                echo json_encode(['status' => 'failed', 'message' => "Product not added"]);   
            }
            
        }
    }

}

?>