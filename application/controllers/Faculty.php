<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Faculty_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $header['page'] = 'Data Fakultas';
        $data['faculties'] = $this->Faculty_model->selectAll();

        $this->load->view('header/header',$header);
        $this->load->view('faculties/index', $data);
        $this->load->view('footer/footer');
    }

    public function create() {
        $header['page'] = 'Tambah Data Fakultas';

        $this->load->view('header/header',$header);
        $this->load->view('faculties/create');
        $this->load->view('footer/footer');
    }

    public function store() {
        $this->form_validation->set_rules('code', 'Code', 'required|max_length[10]|is_unique[faculties.code]');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]|is_unique[faculties.name]');

        if ($this->form_validation->run() === FALSE) {
            $header['page'] = 'Tambah Data Fakultas';
            $data['input_code'] = $this->input->post('code');
            $data['input_name'] = $this->input->post('name');

            $this->load->view('header/header', $header);
            $this->load->view('faculties/create',$data);
            $this->load->view('footer/footer');

            return;
        }

        $data = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name')
        ];

        $result = $this->Faculty_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data fakultas!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data fakultas!');
        }

        redirect('faculty/create');
    }

    public function edit($id) {
        $row = $this->Faculty_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data fakultas tidak ditemukan!');

            redirect('faculty');

            return;
        }
        
        $header['page'] = 'Sunting Data Fakultas';
        $data['input_id'] = $id;
        $data['input_code'] = $row->code;
        $data['input_name'] = $row->name;

        $this->load->view('header/header',$header);
        $this->load->view('faculties/edit', $data);
        $this->load->view('footer/footer');
    }

    public function update() {
        $id = $this->input->post('id');

        $row = $this->Faculty_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data fakultas tidak ditemukan!');

            redirect('faculty');

            return;
        }

        $this->form_validation->set_rules('code', 'Code', 'required|max_length[10]|callback_custom_unique[faculties.code.'.$id.']');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]|callback_custom_unique[faculties.name.'.$id.']');

        if ($this->form_validation->run() === FALSE) {
            $header['page'] = 'Tambah Data Fakultas';
            $data['input_id'] = $this->input->post('id');
            $data['input_code'] = $this->input->post('code');
            $data['input_name'] = $this->input->post('name');

            $this->load->view('header/header', $header);
            $this->load->view('faculties/edit',$data);
            $this->load->view('footer/footer');

            return;
        }

        $data = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name')
        ];

        $result = $this->Faculty_model->update($id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menyunting data fakultas!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyunting data fakultas!');
        }

        redirect('faculty/edit/' . $id);
    }

    public function delete() {
        $id = $this->input->post('id');

        $row = $this->Faculty_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data fakultas tidak ditemukan!');

            redirect('faculty');
            
            return;
        }

        $result = $this->Faculty_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menghapus data fakultas!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data fakultas!');
        }
        
        redirect('faculty');
    }

    function custom_unique($value, $params) {
        list($table, $field, $id) = explode('.', $params);

        $this->db->where($field, $value);
        $this->db->where('id !=', $id);

        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('custom_unique', 'The %s field must contain a unique value.');
            return FALSE;
        }

        return TRUE;
    }
}
