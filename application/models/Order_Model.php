<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model{

    public function place_order($data) {
        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

}

?>