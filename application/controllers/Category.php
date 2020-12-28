<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('Category_model');
    }

    public function index()
    {
        $data['category'] = $this->Category_model->get();
        $this->template->load('template', 'produk/category/category_data', $data);
    }

    public function add()
	{
		$category = new stdClass();
		$category->category_id = null;
        $category->name = null;
		$data = [
			'page' => 'add',
			'category' => $category
		];
		$this->template->load('template', 'produk/category/category_form', $data);
    }

    public function edit($id)
	{
		$query = $this->Category_model->get($id);
		if($query->num_rows() > 0) {
			$category = $query->row();
			$data = [
				'page' => 'edit',
				'category' => $category
			];
			$this->template->load('template', 'produk/category/category_form', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('category');
		}
	}
    
    public function process()
	{
		 $post = $this->input->post(null, TRUE);
		 if(isset($_POST['add'])) {
            $this->Category_model->add($post);
         } else if(isset($_POST['edit'])) {
			$this->Category_model->edit($post);
		 }

		 if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil disimpan.
            </div>');
			redirect('category');
		}
    }
    
    public function delete($id)
	{
		$this->Category_model->delete($id);
		$error = $this->db->error();
		if($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak dapat dihapus (sudah berelasi).
            </div>');
			redirect('category');
		} else if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('category');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('category');
		}
	}

}