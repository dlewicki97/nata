<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_m extends CI_Model
{
    public function get_all_by_productId($table, $productId)
    {
        $this->db->where('product_id', $productId);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_like($like, $limit = 15)
    {
        $this->db->select('products.*, variants.sku, variants.qty');
        $this->db->from('products');
        $this->db->join('variants', 'variants.product_id = products.id');
        $this->db->like('name', $like);
        if ($limit !== -1) $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_by_productId($table, $productId)
    {
        $this->db->where('product_id', $productId);
        $query = $this->db->get($table);
        return $query->row();
    }
    public function get_variants($table, $id)
    {
        $this->db->where(['product_id' => $id]);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function get_category($table, $name)
    {
        $this->db->where('title', $name);
        $query = $this->db->get($table);
        return $query->row();
    }
    public function get_ids()
    {
        $this->db->select('id');
        return $this->db->get('products')->result();
    }

    public function get_names_ids($like)
    {
        $this->db->select('id, name');
        $this->db->like('name', $like);
        return $this->db->get('products')->result();
    }
}