<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('produk_unit');
        if($id != null) {
            $this->db->where('unit_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'name' => $post['name']
        ];
        $this->db->insert('produk_unit', $params);
    }

    public function edit($post)
    {
        $params = [
            'name' => $post['name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('unit_id', $post['unit_id']);
        $this->db->update('produk_unit', $params);
    }

    public function delete($id)
    {
        $this->db->where('unit_id', $id);
        $this->db->delete('produk_unit');
    }

}