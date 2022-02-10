<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_m extends CI_Model
{


    public function get_product_categories($product_id)
    {
        $this->db->where(['product_id' => $product_id]);
        return $this->db->get('products_categories')->result();
    }

    public function count_news_products()
    {
        $this->load->helper('sort_products');
        sort_products();
        $this->db->where(['news' => 1]);
        return @$this->db->count_all_results('products');
    }

    public function count_all_results($table)
    {
        $this->load->helper('sort_products');
        sort_products();
        return @$this->db->count_all_results($table);
    }

    public function count_outlet_products()
    {
        $this->load->helper('sort_products');
        sort_products();
        $this->db->where(['outlet' => 1]);
        return @$this->db->count_all_results('products');
    }

    public function get_product_filters($filter_list_id)
    {
        $this->db->where(['filter_list_id' => $filter_list_id]);
        return $this->db->get('products_filter_lists')->result();
    }

    public function is_category_exist($category_id, $product_id)
    {
        return $this->db->get_where('products_categories', ['category_id' => $category_id, 'product_id' => $product_id])->result();
    }

    public function is_filter_list_exist($filter_list_id, $product_id)
    {
        return $this->db->get_where('products_filter_lists', ['filter_list_id' => $filter_list_id, 'product_id' => $product_id])->result();
    }

    public function get_pagination_category($category_id, $perPage, $paging = 0)
    {
        $this->load->helper('sort_products');
        sort_products();
        $this->db->select('*');
        $this->db->where(['category_id' => $category_id]);
        $this->db->from('products_categories');
        $this->db->join('products', 'products.id = products_categories.product_id');
        $this->db->limit($perPage, $paging);
        return @$this->db->get()->result();
    }

    public function get_pagination_news($perPage, $paging = 0)
    {

        $this->load->helper('sort_products');
        sort_products();
        $this->db->select('*');
        $this->db->where(['news' => 1]);
        $this->db->limit($perPage, $paging);
        return $this->db->get('products')->result();
    }

    public function get_pagination_outlet($perPage, $paging = 0)
    {
        $this->load->helper('sort_products');
        sort_products();
        $this->db->select('*');
        $this->db->where(['outlet' => 1]);
        $this->db->limit($perPage, $paging);
        return $this->db->get('products')->result();
    }

    public function count_category_products($category_id)
    {
        $this->load->helper('sort_products');
        sort_products();
        $this->db->select('*');
        $this->db->where(['category_id' => $category_id]);
        $this->db->from('products_categories');
        $this->db->join('products', 'products.id = products_categories.product_id');
        return @$this->db->get()->num_rows();
    }

    public function get_filter_lists($id)
    {
        $this->db->where('filter_id', $id);
        $this->db->order_by('rand()');
        $this->db->limit(4);
        $query = $this->db->get('filter_lists');
        return $query->result();
    }


    public function get_filter_lists_like($field, $search, $filter_id)
    {
        $this->db->where('filter_id', $filter_id);
        $this->db->like($field, $search);
        $this->db->limit(4);
        return $this->db->get('filter_lists')->result();
    }

    public function get_orderBy_pagging($table, $perPage, $paging = 0)
    {
        $this->load->helper('sort_products');
        sort_products();

        // $this->db->select('id, name, active, price_hurt_brutto, promo_discount, promo_active, promo_start, promo_end, photo_min, alt, price_brutto, news, outlet');

        return @$this->db->get($table, $perPage, $paging)->result();
    }

    public function max_price($table)
    {
        $this->db->select_max('price_brutto');
        $this->db->limit(1);
        $query = $this->db->get($table);
        return $query->row();
    }


    public function get_opinions($table, $id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function variant($table, $id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function gallery($table, $id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_variant_by_sku($table, $sku)
    {
        $this->db->where(['sku' => $sku]);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function update_variant($table, $data, $sku)
    {
        $this->db->where(['sku' => $sku]);
        $query = $this->db->update($table, $data);
        return $query;
    }
}