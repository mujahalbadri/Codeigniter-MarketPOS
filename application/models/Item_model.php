<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('produk_item.*, produk_category.name as category_name, produk_unit.name as unit_name');
        $this->db->from('produk_item');
        $this->db->join('produk_category', 'produk_category.category_id = produk_item.category_id');
        $this->db->join('produk_unit', 'produk_unit.unit_id = produk_item.unit_id');
        if($id != null) {
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('barcode', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price' => $post['price'],
            'image' => $post['image']
        ];
        $this->db->insert('produk_item', $params);
    }

    public function edit($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['name'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('item_id', $post['item_id']);
        $this->db->update('produk_item', $params);
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('produk_item');
        $this->db->where('barcode', $code);
        if($id != null) {
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('produk_item');
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE produk_item SET stock = stock + '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE produk_item SET stock = stock - '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

}