<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission_track extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admission_track_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['page'] = 'Data Jalur Masuk';
        $model['admission_tracks'] = $this->Admission_track_model->selectAll();

        $this->load->view('header/header',$data);
        $this->load->view('admission-tracks/index', $model);
        $this->load->view('footer/footer');
    }

    public function create() {
        $data['page'] = 'Tambah Data Jalur Masuk';

        $this->load->view('header/header',$data);
        $this->load->view('admission-tracks/create');
        $this->load->view('footer/footer');
    }

    public function store() {
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]|is_unique[admission_tracks.name]');

        if ($this->form_validation->run() === FALSE) {
            $data['page'] = 'Tambah Data Jalur Masuk';
            $data['input_name'] = $this->input->post('name');

            $this->load->view('header/header', $data);
            $this->load->view('admission-tracks/create',$data);
            $this->load->view('footer/footer');
            return;
        }

        $data = [
            'name' => $this->input->post('name'),
        ];

        $result = $this->Admission_track_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data jalur masuk!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data jalur masuk!');
        }

        redirect('admission-track/create');
    }

    public function edit($id) {
        $row = $this->Admission_track_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jalur masuk tidak ditemukan!');

            redirect('admission-track');

            return;
        }
        
        $data['page'] = 'Sunting Data Jalur Masuk';
        $data['id'] = $id;
        $data['input_name'] = $row->name;

        $this->load->view('header/header',$data);
        $this->load->view('admission-tracks/edit', $data);
        $this->load->view('footer/footer');
    }

    public function update() {
        $id = $this->input->post('id');

        $row = $this->Admission_track_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jalur masuk tidak ditemukan!');

            redirect('admission-track');

            return;
        }

        $this->form_validation->set_rules('name', 'Name', 'required|max_length[50]|callback_custom_unique[admission_tracks.name.'.$id.']');

        if ($this->form_validation->run() === FALSE) {
            $data['page'] = 'Tambah Data Jalur Masuk';
            $data['id'] = $this->input->post('id');
            $data['input_name'] = $this->input->post('name');

            $this->load->view('header/header', $data);
            $this->load->view('admission-tracks/edit',$data);
            $this->load->view('footer/footer');
            
            return;
        }

        $data = [
            'name' => $this->input->post('name')
        ];

        $result = $this->Admission_track_model->update($id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menyunting data jalur masuk!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyunting data jalur masuk!');
        }

        redirect('admission-track/edit/' . $id);
    }

    public function delete() {
        $id = $this->input->post('id');

        $row = $this->Admission_track_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jalur masuk tidak ditemukan!');

            redirect('admission-track');

            return;
        }

        $result = $this->Admission_track_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menghapus data jalur masuk!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data jalur masuk!');
        }
        
        redirect('admission-track');
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
