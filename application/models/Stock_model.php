<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('transaction_stock');
        if($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete_stock_in($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('transaction_stock');
    }

    public function get_stock_in()
    {
        $this->db->select('transaction_stock.stock_id, produk_item.barcode, produk_item.name as item_name, qty, date, detail, supplier.name as supplier_name, produk_item.item_id');
        $this->db->from('transaction_stock');
        $this->db->join('produk_item', 'transaction_stock.item_id = produk_item.item_id');
        $this->db->join('supplier', 'transaction_stock.supplier_id = supplier.supplier_id', 'left');
        $this->db->where('type','in');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_stock_in($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('id')
        ];
        $this->db->insert('transaction_stock', $params);
    }

    public function get_stock_out()
    {
        $this->db->select('transaction_stock.stock_id, produk_item.barcode, produk_item.name as item_name, qty, date, info, produk_item.item_id');
        $this->db->from('transaction_stock');
        $this->db->join('produk_item', 'transaction_stock.item_id = produk_item.item_id');
        $this->db->where('type','out');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

    public function delete_stock_out($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('transaction_stock');
    }

    public function add_stock_out($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'out',
            'info' => $post['info'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('id')
        ];
        $this->db->insert('transaction_stock', $params);
    }

    public function get_stock()
    {
        $this->db->select('transaction_stock.stock_id, produk_item.barcode, produk_item.name as item_name, qty, date, detail, type, info, supplier.name as supplier_name, produk_item.item_id');
        $this->db->from('transaction_stock');
        $this->db->join('produk_item', 'transaction_stock.item_id = produk_item.item_id');
        $this->db->join('supplier', 'transaction_stock.supplier_id = supplier.supplier_id', 'left');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

    public function delete_stock($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('transaction_stock');
    }

}