<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('Unit_model');
    }

    public function index()
    {
        $data['unit'] = $this->Unit_model->get();
        $this->template->load('template', 'produk/unit/unit_data', $data);
    }

    public function add()
	{
		$unit = new stdClass();
		$unit->unit_id = null;
        $unit->name = null;
		$data = [
			'page' => 'add',
			'unit' => $unit
		];
		$this->template->load('template', 'produk/unit/unit_form', $data);
    }

    public function edit($id)
	{
		$query = $this->Unit_model->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = [
				'page' => 'edit',
				'unit' => $unit
			];
			$this->template->load('template', 'produk/unit/unit_form', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('unit');
		}
	}
    
    public function process()
	{
		 $post = $this->input->post(null, TRUE);
		 if(isset($_POST['add'])) {
            $this->Unit_model->add($post);
         } else if(isset($_POST['edit'])) {
			$this->Unit_model->edit($post);
		 }

		 if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil disimpan.
            </div>');
			redirect('unit');
		}
    }
    
    public function delete($id)
	{
		$this->Unit_model->delete($id);
		$error = $this->db->error();
		if($error['code'] != 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak dapat dihapus (sudah berelasi).
            </div>');
			redirect('unit');
		} else if ($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('unit');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('unit');
		}
	}

}