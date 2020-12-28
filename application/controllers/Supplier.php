<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('Supplier_model');
    }

	public function index()
	{
		$data['supplier'] = $this->Supplier_model->get();
		$this->template->load('template', 'supplier/supplier_data', $data);
	}

	public function add()
	{
		$supplier = new stdClass();
		$supplier->supplier_id = null;
		$supplier->name = null;
		$supplier->phone = null;
		$supplier->address = null;
		$supplier->description = null;
		$data = [
			'page' => 'add',
			'supplier' => $supplier
		];
		$this->template->load('template', 'supplier/supplier_form', $data);
	}

	public function edit($id)
	{
		$query = $this->Supplier_model->get($id);
		if($query->num_rows() > 0) {
			$supplier = $query->row();
			$data = [
				'page' => 'edit',
				'supplier' => $supplier
			];
			$this->template->load('template', 'supplier/supplier_form', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('supplier');
		}
	}

	public function process()
	{
		 $post = $this->input->post(null, TRUE);
		 if(isset($_POST['add'])) {
			$this->Supplier_model->add($post);
		 } else if(isset($_POST['edit'])) {
			$this->Supplier_model->edit($post);
		 }

		 if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil disimpan.
            </div>');
			redirect('supplier');
		}
	}

	public function delete($id)
	{
		$this->Supplier_model->delete($id);
		$error = $this->db->error();
		if($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak dapat dihapus (sudah berelasi).
            </div>');
			redirect('supplier');
		} else if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('supplier');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('supplier');
		}
	}
}
