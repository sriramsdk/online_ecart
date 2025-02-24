<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Order_Model');
        $this->load->library(['session', 'upload']);
    }
    
    public function index()
    {
        $this->load->view('User/layouts/Header');
        $this->load->view('User/User_dashboard');
        $this->load->view('User/layouts/Footer');
    }

    // ------------------ Registration ------------------
    public function register()
    {
        if ($this->input->post()) {
            // Upload path configuration
            $upload_path = "./uploads/users/";
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $config = [
                'upload_path'   => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 2048,
                'encrypt_name'  => TRUE, // Encrypt filename for better security
            ];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('/');
            } else {
                $upload_data = $this->upload->data();
                $image_path = 'uploads/users/' . $upload_data['file_name'];

                // Save user data in the database
                $user_data = [
                    'name'     => $this->input->post('name'),
                    'email'    => $this->input->post('email'),
                    'phone'    => $this->input->post('phone'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'image'    => $image_path
                ];

                if ($this->User_model->insert_user($user_data)) {
                    $this->session->set_flashdata('success', 'Registration successful!');
                    redirect('/');
                } else {
                    $this->session->set_flashdata('error', 'Registration failed!');
                    redirect('/');
                }
            }
        }
    }

    // ------------------ Login ------------------
    public function login()
    {
        if ($this->input->post()) {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');
            $user     = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                // Set user session with image path
                $this->session->set_userdata([
                    'user_id'    => $user['id'],
                    'user_name'  => $user['name'],
                    'user_email' => $user['email'],
                    'user_image' => base_url($user['image']) // Absolute path for image display,                    $this->session->set_userdata('user_image', 'uploads/user/' . $user->image);

                ]);

                $this->session->set_flashdata('success', 'Login successful!');
                redirect('/');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password!');
                redirect('/');
            }
        }
    }

    // ------------------ Logout ------------------
    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'user_name', 'user_email', 'user_image']);
        $this->session->set_flashdata('success', 'Logged out successfully!');
        redirect('/');
    }

    // place order function
    public function place_order(){
        $user_id = $this->session->userdata('user_id');
        $product_id = $this->input->post('product_id');
        $user_address = $this->input->post('user_address');
        $payment_type = $this->input->post('payment_type');
        $quantity = $this->input->post('quantity');

        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'user_address' => $user_address,
            'payment_type' => $payment_type,
            'quantity' => $quantity,
        ];

        $response = $this->Order_Model->place_order($data);

        if($response){
            echo json_encode(['status' => 'success','title' => 'Order Placed', 'message' => "Your order Placed Successfully"]);
        }else{
            echo json_encode(['status' => 'error','title' => 'Order Not Placed', 'message' => "Your Order Not placed"]);   
        }
    }
}
?>
