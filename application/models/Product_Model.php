<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model{

    public function insert_product($product_data) {
        $this->db->insert('products', $product_data);  // Assuming the table is named 'products'
        return $this->db->insert_id(); // Return the insert ID to confirm the record was added
    }

    public function get_products(){
        $data = $this->db->select('*')->from('products')->get()->result_array();
        return $data;
    }

}

?>