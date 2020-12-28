<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Item_model', 'Supplier_model','Stock_model']);
    }

    public function stock_in_data()
    {
        $data['stock'] = $this->Stock_model->get_stock_in()->result();
        $this->template->load('template', 'transaction/stock_in/stock_in_data', $data);
    }

    public function stock_in_add()
    {
        $item = $this->Item_model->get()->result();
        $supplier = $this->Supplier_model->get()->result();
        $data = ['item' => $item, 'supplier' => $supplier];
        $this->template->load('template', 'transaction/stock_in/stock_in_form', $data);
    }

    public function process() 
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['in_add'])) {
            $this->Stock_model->add_stock_in($post);
            $this->Item_model->update_stock_in($post);

            if($this->db->affected_rows() > 0 ) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Stock-In berhasil disimpan.
                </div>');
                redirect('stock/in');
            }
        } else if(isset($_POST['out_add'])) {
            $this->Stock_model->add_stock_out($post);
            $this->Item_model->update_stock_out($post);

            if($this->db->affected_rows() > 0 ) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data Stock-Out berhasil disimpan.
                </div>');
                redirect('stock/out');
            }
        }
    }

    public function stock_in_delete()
    {
        $stock_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $qty = $this->Stock_model->get($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->Item_model->update_stock_out($data);
        $this->Stock_model->delete_stock_in($stock_id);
        if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data Stock-In berhasil dihapus.
			</div>');
        }
        redirect('stock/in');
    }

    public function stock_out_data()
    {
        $data['stock'] = $this->Stock_model->get_stock_out()->result();
        $this->template->load('template', 'transaction/stock_out/stock_out_data', $data);
    }

    public function stock_out_add()
    {
        $item = $this->Item_model->get()->result();
        $data['item'] = $item;
        $this->template->load('template', 'transaction/stock_out/stock_out_form', $data);
    }

    public function stock_out_delete()
    {
        $stock_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $qty = $this->Stock_model->get($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->Item_model->update_stock_in($data);
        $this->Stock_model->delete_stock_out($stock_id);
        if($this->db->affected_rows() > 0 ) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
				Data Stock-Out berhasil dihapus.
			</div>');
        }
        redirect('stock/out');
    }


}