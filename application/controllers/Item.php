<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model(['Item_model', 'Category_model', 'Unit_model']);
    }

    public function index()
    {
        $data['item'] = $this->Item_model->get();
        $this->template->load('template', 'produk/item/item_data', $data);
    }

    public function add()
	{
		$item = new stdClass();
        $item->item_id = null;
        $item->barcode = null;
        $item->name = null;
		$item->price = null;
		$item->category_id = null;
		$item->unit_id = null;
		
		$query_category = $this->Category_model->get();
		$query_unit = $this->Unit_model->get();

		$data = [
			'page' => 'add',
			'item' => $item,
			'category' => $query_category,
			'unit' => $query_unit
		];
		$this->template->load('template', 'produk/item/item_form', $data);
    }

    public function edit($id)
	{
		$query = $this->Item_model->get($id);
		if($query->num_rows() > 0) {
			$item = $query->row();

			$query_category = $this->Category_model->get();
			$query_unit = $this->Unit_model->get();

			$data = [
				'page' => 'edit',
				'item' => $item,
				'category' => $query_category,
				'unit' => $query_unit
			];
			$this->template->load('template', 'produk/item/item_form', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('item');
		}
	}
    
    public function process()
	{
		$config['upload_path'] 	= './assets/dist/img/upload/product/';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']		= 2048;
		$config['file_name']		= 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
		$this->load->library('upload', $config);

		 $post = $this->input->post(null, TRUE);
		 if(isset($_POST['add'])) {
			 if($this->Item_model->check_barcode($post['barcode'])->num_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-ban"></i> Alert!</h5>
					Barcode '. $post['barcode'] .' sudah digunakan dengan barang lain.
				</div>');
				redirect('item/add');
			 } else {
				 if(@$_FILES['image']['name'] != null ) {
					if($this->upload->do_upload('image')) {
						$post['image'] = $this->upload->data('file_name');
						$this->Item_model->add($post);
						if($this->db->affected_rows() > 0 ) {
							$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h5><i class="icon fas fa-check"></i> Alert!</h5>
								Data berhasil disimpan.
							</div>');
						}
						redirect('item');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><i class="icon fas fa-ban"></i> Alert!</h5>'
							. $this->upload->display_errors() .
						'</div>');
						redirect('item/add');
					}
				 } else {
					$post['image'] = null;
					$this->Item_model->add($post);
					if($this->db->affected_rows() > 0 ) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><i class="icon fas fa-check"></i> Alert!</h5>
							Data berhasil disimpan.
						</div>');
					}
					redirect('item');
				 }
			 }
         } else if(isset($_POST['edit'])) {
			if($this->Item_model->check_barcode($post['barcode'], $post['item_id'])->num_rows() > 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5><i class="icon fas fa-ban"></i> Alert!</h5>
					Barcode '. $post['barcode'] .' sudah digunakan dengan barang lain.
				</div>');
				redirect('item/edit/'.$post['item_id']);
			 } else {
				if(@$_FILES['image']['name'] != null ) {
					if($this->upload->do_upload('image')) {

						$item = $this->Item_model->get($post['item_id'])->row();
						if($item->image != null) {
							$target_file = './assets/dist/img/upload/product/'.$item->image;
							unlink($target_file);
						}

						$post['image'] = $this->upload->data('file_name');
						$this->Item_model->edit($post);
						if($this->db->affected_rows() > 0 ) {
							$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<h5><i class="icon fas fa-check"></i> Alert!</h5>
								Data berhasil disimpan.
							</div>');
						}
						redirect('item');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><i class="icon fas fa-ban"></i> Alert!</h5>'
							. $this->upload->display_errors() .
						'</div>');
						redirect('item/edit/'. $post['item_id']);
					}
				 } else {
					$post['image'] = null;
					$this->Item_model->edit($post);
					if($this->db->affected_rows() > 0 ) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><i class="icon fas fa-check"></i> Alert!</h5>
							Data berhasil disimpan.
						</div>');
					}
					redirect('item');
				 }
			 }
		 }
    }
    
    public function delete($id)
	{
		$item = $this->Item_model->get($id)->row();
		if($item->image != null) {
			$target_file = './assets/dist/img/upload/product/'.$item->image;
			unlink($target_file);
		}
		$this->Item_model->delete($id);
		if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('item');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('item');
		}
	}


	public function barcode_qrcode($id)
	{
		$data['item'] = $this->Item_model->get($id)->row();
        $this->template->load('template', 'produk/item/barcode_qrcode', $data);
	}


}