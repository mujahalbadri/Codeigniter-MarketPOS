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
        $invoice = "MP".date('ymd').$no;
        return $invoice;
    }

    public function get($id = null)
    {
        $this->db->select('cart.*, produk_item.name as item_name, ((cart.price*cart.qty)-((cart.price*cart.qty)*(cart.discount/100))) as sub_total ');
        $this->db->from('cart');
        $this->db->join('produk_item', 'produk_item.item_id = cart.item_id');
        if($id != null) {
            $this->db->where('cart_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'barcode' => $post['barcode'],
            'price' => $post['price'],
            'qty' => $post['qty']
        ];
        $this->db->insert('cart', $params);
    }

    public function delete_cart($id)
    {
        $this->db->where('cart_id', $id);
        $this->db->delete('cart');
    }

    public function edit_cart($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount' => $post['discount'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('cart', $params);
    }


}