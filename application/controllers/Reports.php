<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		check_not_login();
		$this->load->model(['Sale_model','Stock_model']);
    }

    public function sales()
	{
		$data = [
			'sale' => $this->Sale_model->get_sale()->result(),
			'sale_detail' => $this->Sale_model->get_sale_detail()->result()
		];
		$this->template->load('template', 'reports/sales/reports_sales', $data);
	}
	
	public function del_sale($id) 
	{
		$this->Sale_model->delete_sale($id);
		if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('reports/sales');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('reports/sales');
		}
	}

    public function cetak($id) 
	{
		$data = [
			'sale' => $this->Sale_model->get_sale($id)->result(),
			'sale_detail' => $this->Sale_model->get_sale_detail($id)->result()
		];
		$this->load->view('transaction/sale/struk_print', $data);	
	}
    
    public function stocks()
	{
		$stock = $this->Stock_model->get_stock()->result();
		$data = [
			'stock' => $stock
		];
		$this->template->load('template', 'reports/stocks/reports_stocks', $data);
	}
	
	public function del_stock($id) 
	{
		$this->Stock_model->delete_stock($id);
		if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data berhasil dihapus.
			</div>');
			redirect('reports/stocks');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
			redirect('reports/stocks');
		}
	}

}