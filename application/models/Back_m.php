<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Back_m extends CI_Model
{
    public function get_all($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_with_limit($table, $limit = 0)
    {
        $this->db->limit($limit);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_like($table, $field, $value, $limit = 15)
    {
        $this->db->like($field, $value);
        if ($limit !== -1) $this->db->limit($limit);
        return $this->db->get($table)->result();
    }

    public function get_like_one($table, $field, $value)
    {
        $this->db->like($field, $value);
        return $this->db->get($table)->row();
    }

    public function get_all_where($table, $field, $value, $sort = null)
    {
        if (is_string($sort)) $this->db->order_by('id', $sort);
        if (is_array($sort)) $this->db->order_by($sort[0], $sort[1]);
        $this->db->where([$field => $value]);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function get_where_array($table, $arr)
    {
        $this->db->where($arr);
        return $this->db->get($table)->row();
    }


    public function get_where_row($table, $arr)
    {
        return $this->db->where($arr)->get($table)->row();
    }
    public function get_where($table, $field, $value, $order = NULL)
    {
        if ($order) $this->db->order_by('created', $order);
        $this->db->where([$field => $value]);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function get_where_result($table, $where)
    {
        $this->db->where($where);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_all_priority($table, $active = '')
    {
        if ($active) {
            $this->db->where($active, 1);
        }
        $this->db->order_by("priority", "asc");
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_one($table, $id)
    {
        $this->db->where(['id' => $id]);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function get_where_in($table, $field, $arr)
    {
        $this->db->where_in($field, $arr);
        return $this->db->get($table)->result();
    }

    public function get_random($table, $limit, $id = '')
    {
        $this->db->where('id !=', $id);
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_where_random($table, $where, $limit)
    {
        $this->db->where($where);
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        return $this->db->get($table)->result();
    }

    public function get_random_one_awarded($table)
    {
        $this->db->where('awarded', 1);
        $this->db->order_by('rand()');
        $this->db->limit(1);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function get_random_news($table)
    {
        $this->db->where('news', 1);
        $this->db->order_by('rand()');
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_images($table, $table_name, $id)
    {
        $this->db->where([
            'item_id' => $id,
            'table_name' => $table_name,
        ]);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_categories($table, $id)
    {
        $this->db->where('category', $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function insert($table, $data)
    {
        // $data = $this->security->xss_clean($data);
        $query = $this->db->insert($table, $data);
        return $query;
    }

    public function insert_furgonetka($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $query;
    }

    public function update($table, $data, $id)
    {
        // $data = $this->security->xss_clean($data);
        $this->db->where(['id' => $id]);
        $query = $this->db->update($table, $data);
        return $query;
    }

    public function cancel_shipment($shipment_id)
    {
        $this->load->library('furgonetka');
        $f = $this->furgonetka->cancel_shipment($shipment_id);
        $this->db->where(['shipment_id' => $shipment_id]);
        $query = $this->db->delete('shipment');
    }

    public function delete($table, $id)
    {
        $this->db->where(['id' => $id]);
        $query = $this->db->delete($table);
        return $query;
    }

    public function get_products_by_category($table)
    {
        $this->db->limit(4);
        $this->db->where('subcategory !=', null);
        $this->db->order_by('priority', 'desc');
        $this->db->order_by('rand()');
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_products_by_category_magic_section($table, $id)
    {
        $this->db->limit(4);
        $this->db->where('subcategory', $id);
        $this->db->order_by('priority', 'desc');
        $this->db->order_by('rand()');
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_product_opinions($table, $id)
    {
        $this->db->where(['product_id' => $id]);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_user_opinion_for_product(string $table, ?int $user_id, int $product_id): ?object
    {

        $this->db->where([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'active' => 1,
        ]);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function get_count($table)
    {
        return $this->db->count_all_results($table);
    }

    public function count_users_opinions($table, $grade, $product_id)
    {

        $this->db->where([
            'grade' => $grade,
            'product_id' => $product_id,
            'active' => 1,
        ]);

        return $this->db->get($table)->num_rows();
    }

    public function count_product_opinions($table, $product_id)
    {

        $this->db->where([
            'product_id' => $product_id,
            'active' => 1,
        ]);
        return $this->db->get($table)->num_rows();
    }

    public function average_users_opinions($table, $product_id)
    {

        $this->db->where([
            'product_id' => $product_id,
            'active' => 1,
        ]);
        $this->db->select_avg('grade');
        $query = $this->db->get($table)->row();
        return $query->grade;
    }

    public function get_users_from_group($table, $group_id)
    {

        $this->db->where([
            'client_group' => $group_id,
        ]);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function count_users_in_group($table, $group_id)
    {

        $this->db->where([
            'client_group' => $group_id,
            'active' => 1,
        ]);
        return $this->db->get($table)->num_rows();
    }

    public function get_transactions_by_typeaccount($table, $typeclient)
    {
        $this->db->where([
            'type_client' => $typeclient,
            'status !=' => 5
        ]);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_finished_transactions_by_typeaccount($table, $typeclient)
    {
        $this->db->where([
            'type_client' => $typeclient,
            'status' => 5
        ]);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_user_orders($table, $id)
    {
        $this->db->where([
            'client_id' => $id
        ]);
        $query = $this->db->get($table);
        return $query->result();
    }


    public function get_shipment_data($table, $id)
    {
        $this->db->where(['transaction_id' => $id]);
        $query = $this->db->get($table);
        return $query->row();
    }

    public function get_report($table, $start, $end)
    {
        $this->db->where('created >=', $start);
        $this->db->where('created <=', $end);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function get_panel_products()
    {
        if (isset($_COOKIE['panelProductsSearch']) && $_COOKIE['panelProductsSearch']) {
            $this->db->like('name', $_COOKIE['panelProductsSearch']);
        }
        return $this->db->get('products')->result();
    }

    public function get_paging($table, $perPage, $paging = 0)
    {
        $this->db->order_by("priority", "desc");
        if (isset($_COOKIE['panelProductsSearch']) && $_COOKIE['panelProductsSearch']) {
            $this->db->like('name', $_COOKIE['panelProductsSearch']);
        }
        $query = $this->db->get($table, $perPage, $paging);

        return $query->result();
    }
    public function get_inventory_paging($table, $perPage, $paging = 0)
    {
        $query = $this->db->get($table, $perPage, $paging);

        return $query->result();
    }

    public function get_ordersBy_pagging($id, $perPage, $paging = 0)
    {
        $this->db->where('client_id', $id);
        $this->db->order_by("created", "desc");
        $query = $this->db->get('transaction', $perPage, $paging);

        return $query->result();
    }

    public function get_awaiting_users($table, $id)
    {
        $this->db->where(['product_id' => $id]);
        $query = $this->db->get($table);
        return $query->result();
    }
}