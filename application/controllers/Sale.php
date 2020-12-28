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
		$cart = $this->Sale_model->get_cart()->result();
		$data = [
			'customer' => $customer,
			'item' => $item,
			'cart' => $cart,
			'invoice' => $this->Sale_model->invoice_no(),
		];
		$this->template->load('template', 'transaction/sale/sale_form', $data);
	}

	public function process()
	{
		$data = $this->input->post(null, TRUE);

		if(isset($_POST['add_cart'])) {

			$item_id = $this->input->post('item_id');
			$check_cart = $this->Sale_model->get_cart(['cart.item_id' => $item_id])->num_rows();
			if( $check_cart > 0) {
				$this->Sale_model->update_cart_qty($data);
			} else {
				$this->Sale_model->add_cart($data);
			}
			
			
			if($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		} 
		if(isset($_POST['edit_cart'])) {
			$this->Sale_model->edit_cart($data);

			if($this->db->affected_rows() > 0) {
				$params = array("success" => true);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
		if(isset($_POST['process_payment'])) {
			$sale_id = $this->Sale_model->add_sale($data);
			$cart = $this->Sale_model->get_cart()->result();
			$row = [];
			foreach($cart as $c => $value) {
				array_push($row, array(
					'sale_id' => $sale_id,
					'item_id' => $value->item_id,
					'price' => $value->price,
					'qty' => $value->qty,
					'discount' => $value->discount,
					'total' => $value->total
					)
				);
			}
			$this->Sale_model->add_sale_detail($row);
			$this->Sale_model->del_cart(['user_id' => $this->session->userdata('id')]);
			if($this->db->affected_rows() > 0) {
				$params = array("success" => true, "sale_id" => $sale_id);
			} else {
				$params = array("success" => false);
			}
			echo json_encode($params);
		}
	}

	function cart_data() 
	{
		$cart = $this->Sale_model->get_cart()->result();
		$data['cart'] = $cart;
		$this->load->view('transaction/sale/cart_data', $data);
	}

	public function cart_del() 
	{
		$cart_id = $this->input->post('cart_id');
		$this->Sale_model->del_cart(['cart_id' => $cart_id]);

		if($this->db->affected_rows() > 0) {
			$params = array("success" => true);
		} else {
			$params = array("success" => false);
		}
		echo json_encode($params);
	}

	public function cetak($id) 
	{
		$data = [
			'sale' => $this->Sale_model->get_sale($id)->result(),
			'sale_detail' => $this->Sale_model->get_sale_detail($id)->result()
		];
		$this->load->view('transaction/sale/struk_print', $data);	
	}

	

	
}
