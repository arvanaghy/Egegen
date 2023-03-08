<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_Model extends CI_Model
{


    public function insertProduct($data)
    {
        $this->db->insert('products', $data);
    }

    public function listProducts()
    {
        $query = $this->db->get('products');
        if ($query->result()){
            return $query->result();
        }
        return False;
    }

    public function getProductByID($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('products');
        if ($query->result()){
            return $query->row();
        }
        return False;
    }

    public function Retrieving_Full_Tree()
    {
        $query = $this->db->query("SELECT node.product_name,node.product_id,node.rgt,node.lft
FROM `12e4b1D_nested_products` AS node,
        `12e4b1D_nested_products` AS parent
WHERE node.lft BETWEEN parent.lft AND parent.rgt
        AND parent.product_id = 1
ORDER BY node.lft;");
        if ($query->result()){
            return $query->result();
        }
        return False;
    }

}