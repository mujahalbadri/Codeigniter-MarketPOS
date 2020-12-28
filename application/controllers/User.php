<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('User_model');
    }

	public function index()
	{
        $data['users'] = $this->User_model->get();
		$this->template->load('template', 'user/user_data', $data);
    }
    
    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[user.username]');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[5]|matches[password1]',
            ['matches' => '%s tidak sesuai dengan password']
        );
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');
        $this->form_validation->set_message('is_unique', '{field} ini sudah dipakai, silahkan menggunakan {field} lain');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template', 'user/user_form_add');
        } else {
            $post = $this->input->post(null, TRUE);
            $this->User_model->add($post);
            if($this->db->affected_rows() > 0 ) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data berhasil disimpan.
                </div>');
            }
            redirect('user');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');

        if($this->input->post('password1')) {
            $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[5]');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|min_length[5]|matches[password1]',
            ['matches' => '%s tidak sesuai dengan password']);
        }
        if($this->input->post('password2')) {
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|min_length[5]|matches[password1]',
            ['matches' => '%s tidak sesuai dengan password']);
        }
        
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} minimal 5 karakter');

        if ($this->form_validation->run() == FALSE) {
            $query = $this->User_model->get($id);
            if($query -> num_rows() > 0) {
                $data['user'] = $query->row();
                $this->template->load('template', 'user/user_form_edit', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Data tidak ditemukan.
                </div>');
            }
        } else {
            $post = $this->input->post(null, TRUE);
            
            // Cek jika ada gambar yang akan diUpload
            $upload_image = $_FILES['image']['name'];

            if($upload_image != null) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/dist/img/profile';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    $old_image = $this->User_model->get($post['id'])->row();
                    if($old_image->image != 'default.png') {
                        unlink('./assets/dist/img/profile/' . $old_image->image);
                    }
                    $post['image'] = $this->upload->data('file_name');
                    $this->User_model->edit($post);

                    if($this->db->affected_rows() > 0 ) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            Data berhasil disimpan.
                        </div>');
                    }
                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>'
                        . $this->upload->display_errors() .
                    '</div>');
                    redirect('user/edit/'. $post['id']);
                    
                }
            }

            $this->User_model->edit($post);
            if($this->db->affected_rows() > 0 ) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Data berhasil disimpan.
                </div>');
            }
            redirect('user');
        }
    }

    public function delete($id)
    {
        $old_image = $this->User_model->get($id)->row();
        if($old_image->image != 'default.png') {
            unlink('./assets/dist/img/profile/' . $old_image->image);
        }
        $this->User_model->delete($id);
        if($this->db->affected_rows() > 0 ) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                Data berhasil dihapus.
            </div>');
        redirect('user');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Data tidak ditemukan.
            </div>');
            redirect('user');
        }
    }

}
