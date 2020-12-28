<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model('Customer_model');
    }

    public function index()
    {
        $data['customer'] = $this->Customer_model->get();
        $this->template->load('template', 'customer/customer_data', $data);
    }

    public function add()
	{
		$customer = new stdClass();
		$customer->customer_id = null;
        $customer->name = null;
        $customer->gender = null;
		$customer->phone = null;
		$customer->address = null;
		$data = [
			'page' => 'add',
			'customer' => $customer
		];
		$this->template->load('template', 'customer/customer_form', $data);
    }

    public function edit($id)
	{
		$query = $this->Customer_model->get($id);
		if($query->num_rows() > 0) {
			$customer = $query->row();
			$data = [
				'page' => 'edit',
				'customer' => $customer
			];
			$this->template->load('template', 'customer/customer_form', $data);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('customer');
		}
	}
    
    public function process()
	{
		 $post = $this->input->post(null, TRUE);
		 if(isset($_POST['add'])) {
            $this->Customer_model->add($post);
         } else if(isset($_POST['edit'])) {
			$this->Customer_model->edit($post);
		 }

		 if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Data berhasil disimpan.
            </div>');
			redirect('customer');
		}
    }
    
    public function delete($id)
	{
		$this->Customer_model->delete($id);
		if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('customer');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('customer');
		}
	}

}