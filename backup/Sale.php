<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model(['Sale_model','Customer_model','Item_model']);
    }

	public function index()
	{
		$customer = $this->Customer_model->get()->result();
		$item = $this->Item_model->get()->result();
		$cart = $this->Sale_model->get()->result();
		$data = [
			'customer' => $customer,
			'invoice' => $this->Sale_model->invoice_no(),
			'item' => $item,
			'cart' => $cart
		];
		$this->template->load('template', 'transaction/sale/sale_form', $data);
	}

	public function add_cart()
	{
		$post = $this->input->post(null, TRUE);
        if(isset($_POST['add_cart'])) {
            $this->Sale_model->add_cart($post);

            if($this->db->affected_rows() > 0 ) {
                redirect('sale');
			}
		}
	}

	public function edit_cart()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['edit'])) {
			$this->Sale_model->edit_cart($post);
		 }
		 if($this->db->affected_rows() > 0 ) {
			redirect('sale');
		} else {
			redirect('sale');
		}
	}

	public function delete_cart($id)
	{
		$this->Sale_model->delete_cart($id);
		if($this->db->affected_rows() > 0 ) {
			redirect('sale');
		} else {
			redirect('sale');
		}
	}

	
}
