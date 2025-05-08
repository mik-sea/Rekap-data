<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Major_model');
        $this->load->model('Faculty_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $majors = $this->Major_model->selectAll();
        foreach ($majors as $major) {
            $faculty = $this->Faculty_model->select($major->faculty_id);
            $major->faculty_name = $faculty->name;
        }

        $data['page'] = 'Data Jurusan';
        $model['majors'] = $majors;

        $this->load->view('header/header',$data);
        $this->load->view('majors/index', $model);
        $this->load->view('footer/footer');
    }

    public function create() {
        $data['page'] = 'Tambah Data Jurusan';
        $model['faculties'] = $this->Faculty_model->selectAll();

        $this->load->view('header/header',$data);
        $this->load->view('majors/create', $model);
        $this->load->view('footer/footer');
    }

    public function store() {
        $this->form_validation->set_rules('faculty_id', 'Faculty ID', 'required|is_numeric');
        $this->form_validation->set_rules('code', 'Code', 'required|max_length[10]|is_unique[majors.code]');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');

        if ($this->form_validation->run() === FALSE) {
            $data['page'] = 'Tambah Data Jurusan';
            $data['input_faculty_id'] = $this->input->post('faculty_id');
            $data['input_code'] = $this->input->post('code');
            $data['input_name'] = $this->input->post('name');
            $data['faculties'] = $this->Faculty_model->selectAll(); 

            $this->load->view('header/header', $data);
            $this->load->view('majors/create',$data);
            $this->load->view('footer/footer');
            return;
        }

        $data = [
            'faculty_id' => $this->input->post('faculty_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
        ];

        $result = $this->Major_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data jurusan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data jurusan!');
        }

        redirect('major/create');
    }

    public function edit($id) {
        $row = $this->Major_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jurusan tidak ditemukan!');

            redirect('major');

            return;
        }
        
        $data['page'] = 'Sunting Data Jurusan';
        $data['input_id'] = $id;
        $data['input_faculty_id'] = $row->faculty_id;
        $data['input_code'] = $row->code;
        $data['input_name'] = $row->name;
        $data['faculties'] = $this->Faculty_model->selectAll();

        $this->load->view('header/header',$data);
        $this->load->view('majors/edit', $data);
        $this->load->view('footer/footer');
    }

    public function update() {
        $id = $this->input->post('id');

        $row = $this->Major_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jurusan tidak ditemukan!');

            redirect('major');

            return;
        }

        $this->form_validation->set_rules('faculty_id', 'Faculty ID', 'required|is_numeric');
        $this->form_validation->set_rules('code', 'Code', 'required|max_length[10]|callback_custom_unique[majors.code.'.$id.']');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]');

        if ($this->form_validation->run() === FALSE) {
            $data['page'] = 'Tambah Data Jurusan';
            $data['input_id'] = $this->input->post('id');
            $data['input_faculty_id'] = $this->input->post('faculty_id');
            $data['input_code'] = $this->input->post('code');
            $data['input_name'] = $this->input->post('name');
            $data['faculties'] = $this->Faculty_model->selectAll();

            $this->load->view('header/header', $data);
            $this->load->view('majors/edit',$data);
            $this->load->view('footer/footer');
            
            return;
        }

        $data = [
            'faculty_id' => $this->input->post('faculty_id'),
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name')
        ];

        $result = $this->Major_model->update($id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menyunting data jurusan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyunting data jurusan!');
        }

        redirect('Major/edit/' . $id);
    }

    public function delete() {
        $id = $this->input->post('id');

        $row = $this->Major_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data jurusan tidak ditemukan!');

            redirect('major');

            return;
        }

        $result = $this->Major_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menghapus data jurusan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data jurusan!');
        }
        
        redirect('major');
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
