<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model{

    public function place_order($data) {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function my_orders($user_id){
        $this->db->select('ord.*,pro.*');
        $this->db->from('orders as ord');
        $this->db->join('products as pro','ord.product_id = pro.id','left');
        $this->db->where('ord.user_id',$user_id);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function get_all_orders(){
        $this->db->select('ord.*,pro.*,u.*');
        $this->db->from('orders as ord');
        $this->db->join('products as pro','ord.product_id = pro.id','left');
        $this->db->join('users as u','ord.user_id = u.id','left');
        $data = $this->db->get()->result_array();
        return $data;
    }

}

?>