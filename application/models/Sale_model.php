<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_model extends CI_Model {

    public function Invoice_no()
    {
        $sql = "SELECT MAX(mid(invoice,9,4)) AS invoice_no FROM transaction_sale WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "PM".date('ymd').$no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, produk_item.name as item_name, cart.price as cart_price ');
        $this->db->from('cart');
        $this->db->join('produk_item', 'produk_item.item_id = cart.item_id');
        if($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM cart");
        if($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = 1;
        }

        $params = [
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('id')
        ];
        $this->db->insert('cart', $params);
    }

    public function update_cart_qty($post) {
        $sql = "UPDATE cart SET price = '$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]' * qty
                WHERE item_id = '$post[item_id]'";
                $this->db->query($sql);
    }

    public function del_cart($params = null) {
        if($params != null ) {
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function edit_cart($post) {
        $params = [
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount' => $post['discount'],
            'total' => $post['total'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('cart', $params);
    }
    
    public function add_sale($post) {
        $params = [
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'],
            'total_price' => $post['subtotal'],
            'discount' => $post['discount'],
            'final_price' => $post['grandtotal'],
            'cash' => $post['cash'],
            'remaining' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('id')
        ];
        $this->db->insert('transaction_sale', $params);
        return $this->db->insert_id();
    }

    public function add_sale_detail($params) {
        $this->db->insert_batch('transaction_sale_detail', $params);
    }

    public function get_sale($id = null) {
        $this->db->select('*, customer.name as customer_name, user.name as user_name, transaction_sale.created as sale_created');
        $this->db->from('transaction_sale');
        $this->db->join('customer', 'transaction_sale.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'transaction_sale.user_id = user.id');
        if($id != null) {
            $this->db->where('sale_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($sale_id = null) {
        $this->db->from('transaction_sale_detail');
        $this->db->join('produk_item', 'transaction_sale_detail.item_id = produk_item.item_id',);
        if($sale_id != null) {
            $this->db->where('sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete_sale($id)
    {
        $this->db->where('sale_id', $id);
        $this->db->delete('transaction_sale');
    }
        
    

}