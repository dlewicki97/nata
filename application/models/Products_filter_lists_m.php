<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products_filter_lists_m extends CI_Model
{
    protected $table = 'products_filter_lists';

    public function get_by_products_ids(array $products_ids, int $limit = 0)
    {
        $this->db->select("$this->table.id, filter_list_id, filter_id, filter_lists.title, filters.title as filter_title");
        $this->db->from("$this->table, filter_lists");
        if ($products_ids) $this->db->where_in("$this->table.product_id", $products_ids);
        $this->db->where("filter_lists.id = $this->table.filter_list_id");
        $this->db->join('filters', 'filters.id = filter_id');
        $this->db->group_by("filter_list_id");
        $this->db->order_by("title", 'asc');
        if ($limit) $this->db->limit($limit);

        return @$this->db->get()->result();
    }
}