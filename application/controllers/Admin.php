<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Admin side controller
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_Model');
        $this->load->model('User_model');
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

    // add product function
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
            echo json_encode(['status' => 'error','title' => 'Image Not Uploaded', 'message' => 'Failed to upload image']);
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
                'product_discount' => $product_discount,
                'final_price' => $final_price,
                'product_image' => $image_path,
                'company' => $company,
                'category' => $category
            );

            $response = $this->Product_Model->insert_product($product_data);

            if($response){
                echo json_encode(['status' => 'success','title' => 'Product Added', 'message' => "Product added successfully"]);
            }else{
                echo json_encode(['status' => 'error','title' => 'Product Not Added', 'message' => "Product not added"]);   
            }
            
        }
    }

    // get all products to list in view page
    public function get_all_products(){

        $products = $this->Product_Model->get_products();
        if(empty($products)){
            echo json_encode(['status' => 'error', 'title' => 'Products not fetched', 'message' => 'Products not fetched']);
        }else{
            echo json_encode(['status' => 'success', 'title' => 'Products fetched', 'message' => 'Products fetched successfully', 'data' => $products]);
        }
        
    }

    // delete product function
    public function delete_product(){

        $id = $this->input->post('id');
        $response = $this->Product_Model->delete_product($id);
        if($response){
            echo json_encode([ 'status' => 'success' , 'title' => 'success', 'message' => 'Product deleted successfully' ]);
        }else{
            echo json_encode([ 'status' => 'error' , 'title' => 'failure', 'message' => 'Product not deleted' ]);
        }

    }

    // get product details function
    public function get_product_details(){

        $id = $this->input->post('id');
        // echo "<pre>";print_r($id);exit();
        if(!empty($id)){
            $response = $this->Product_Model->get_product_details($id);
            if(!empty($response)){
                echo json_encode([ 'status' => 'success' , 'title' => 'success', 'message' => 'Product details fetched successfully' , 'data' => $response ]);
            }else{
                echo json_encode([ 'status' => 'error' , 'title' => 'failure', 'message' => 'Product details not available' ]);
            }
        }else{
            echo json_encode([ 'status' => 'error' , 'title' => 'failure', 'message' => 'Unable to get product details' ]);
        }

    }

    // update product function
    public function update_product(){

        $upload_path = "./uploads/products/";

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, true);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = "jpg|jpeg|png|gif";
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $id = $this->input->post('id');
            $product_name = $this->input->post('product_name');
            $product_price = $this->input->post('product_price');
            $product_discount = $this->input->post('product_discount');
            $final_price = $this->input->post('final_price');
            $company = $this->input->post('company');
            $category = $this->input->post('category');

        if (!$this->upload->do_upload('product_image')) {
            $error = $this->upload->display_errors();
            // echo json_encode(['status' => 'error','title' => 'Image Not Uploaded', 'message' => 'Failed to upload image']);
            $product_data = array(
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_discount' => $product_discount,
                'final_price' => $final_price,
                'company' => $company,
                'category' => $category
            );
        } else {
            $upload_data = $this->upload->data();
            $image_path = 'uploads/products/' . $upload_data['file_name'];
            $product_data = array(
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_discount' => $product_discount,
                'final_price' => $final_price,
                'product_image' => $image_path,
                'company' => $company,
                'category' => $category
            );
        }    

        $response = $this->Product_Model->update_product($product_data,$id);

        if($response){
            echo json_encode(['status' => 'success','title' => 'Product Updated', 'message' => "Product updated successfully"]);
        }else{
            echo json_encode(['status' => 'error','title' => 'Product Not Updated', 'message' => "Product not updated"]);   
        }
            
    }

    // fetch Users list function
    public function fetchUsers() {
        $list = $this->User_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $user) {
            $no++;
            $row = array();
            $row['id'] = $user->id;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['phone'] = $user->phone;
            $row['created_at'] = $user->created_at;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

}

?>