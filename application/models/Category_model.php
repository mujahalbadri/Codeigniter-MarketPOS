<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('produk_category');
        if($id != null) {
            $this->db->where('category_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name']
        ];
        $this->db->insert('produk_category', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('category_id', $post['category_id']);
        $this->db->update('produk_category', $params);
    }

    public function delete($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('produk_category');
    }

}