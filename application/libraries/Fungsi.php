<?php 

Class Fungsi {

    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('User_model');
        $user_id = $this->ci->session->userdata('id');
        $user_data = $this->ci->User_model->get($user_id)->row();
        return $user_data;
    }

    public function count_item() {
        $this->ci->load->model('Item_model');
        return $this->ci->Item_model->get()->num_rows();
    }

    public function count_supplier() {
        $this->ci->load->model('Supplier_model');
        return $this->ci->Supplier_model->get()->num_rows();
    }
    public function count_customer() {
        $this->ci->load->model('Customer_model');
        return $this->ci->Customer_model->get()->num_rows();
    }

    public function count_user() {
        $this->ci->load->model('User_model');
        return $this->ci->User_model->get()->num_rows();
    }

}