<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_categories_m extends CI_Model
{
    protected $table = 'products_categories';

    public function get_joined_category($category_id, $like)
    {
        $this->db->select('products_categories.id, products_categories.category_id, products_categories.product_id, products.name');
        $this->db->from('products_categories');
        $this->db->where(['category_id' => $category_id]);
        $this->db->like('products.name', $like);
        $this->db->join('products', 'products_categories.product_id = products.id');
        return $this->db->get()->result();
    }
    public function get_joined_categories($product_id)
    {
        $this->db->select('*');
        $this->db->from('products_categories');
        $this->db->where(['product_id' => $product_id]);
        $this->db->join('categories', 'products_categories.category_id = categories.id');
        return $this->db->get()->result();
    }

    public function get_products_ids($category_id): array
    {
        return $category_id ? $this->db->select('product_id')->where('category_id', $category_id)->limit($_COOKIE['perPage'] ?? 16, $this->uri->segment(5) ?? 0)->get($this->table)->result() : [];
    }
    public function get_products_ids_api($category_id): array
    {
        return $category_id ? $this->db->select('product_id')->where('category_id', $category_id)->get($this->table)->result() : $this->db->select('product_id')->distinct()->get($this->table)->result();
    }
}