<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model{

    public function insert_product($product_data) {
        $this->db->insert('products', $product_data);  // Assuming the table is named 'products'
        return $this->db->insert_id(); // Return the insert ID to confirm the record was added
    }

    public function get_products(){
        $data = $this->db->select('*')->from('products')->order_by('id','DESC')->get()->result_array();
        return $data;
    }

    public function delete_product($id){
        $data = $this->db->where('id',$id)->delete('products');
        return $data;
    }

    public function get_product_details($id){
        $data = $this->db->select('*')->from('products')->where('id',$id)->get()->row_array();
        $product_data = [
            "product_name" => $data['product_name'],
            "product_price" => $data['product_price'],
            "product_image" => base_url('/').$data['product_image'],
            "product_discount" => $data['product_discount'],
            "final_price" => $data['final_price'],
            "company" => $data['company'],
            "category" => $data['category'],
            "id" => $data['id'],
        ];
        return $product_data;
    }

    public function update_product($data,$id){
        $response = $this->db->where('id',$id)->update('products',$data);
        return $response;
    }

}

?>