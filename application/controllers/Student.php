<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Admission_track_model');
        $this->load->model('Faculty_model');
        $this->load->model('Major_model');
        $this->load->model('Student_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index(){
        $students = $this->Student_model->selectAll();
        foreach ($students as $student) {
            $student->faculty = $this->Faculty_model->select($student->faculty_id)->name;
            $student->major = $this->Major_model->select($student->major_id)->name;
        }

        $header['page'] = "Data Mahasiswa";
        $data['students'] = $students;

		$this->load->view('header/header',$header);
		$this->load->view('students/index',$data);
		$this->load->view('footer/footer');
    }
    
    public function create(){
        $header['page'] = "Tambah Data Mahasiswa";
        $data['admission_tracks'] = $this->Admission_track_model->selectAll();
        $data['majors'] = $this->Major_model->selectAll();

        $this->load->view('header/header',$header);
		$this->load->view('students/create', $data);
		$this->load->view('footer/footer');
    }

    public function store() {
        $this->form_validation->set_rules('student_identification_number', 'Student Identification Number', 'required|max_length[8]|is_unique[students.student_identification_number]');
        $this->form_validation->set_rules('admission_track_id', 'Admission Track ID', 'required|is_numeric');
        $this->form_validation->set_rules('major_id', 'Major ID', 'required|is_numeric');
        $this->form_validation->set_rules('location', 'Location', 'required|max_length[100]');
        $this->form_validation->set_rules('class', 'Class', 'required|max_length[5]');
        $this->form_validation->set_rules('profile_photo', 'Profile Photo', 'callback_validate_profile_photo');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required|max_length[100]');
        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
        $this->form_validation->set_rules('religion', 'Religion', 'required|max_length[50]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $header['page'] = 'Tambah Data Mahasiswa';
            $data['input_student_identification_number'] = $this->input->post('student_identification_number');
            $data['input_admission_track_id'] = $this->input->post('admission_track_id');
            $data['input_major_id'] = $this->input->post('major_id');
            $data['input_location'] = $this->input->post('location');
            $data['input_class'] = $this->input->post('class');
            $data['input_name'] = $this->input->post('name');
            $data['input_place_of_birth'] = $this->input->post('place_of_birth');
            $data['input_date_of_birth'] = $this->input->post('date_of_birth');
            $data['input_religion'] = $this->input->post('religion');
            $data['input_gender'] = $this->input->post('gender');
            $data['admission_tracks'] = $this->Admission_track_model->selectAll();
            $data['majors'] = $this->Major_model->selectAll();

            $this->load->view('header/header', $header);
            $this->load->view('students/create',$data);
            $this->load->view('footer/footer');

            return;
        }

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 5120;
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_photo')) {
            $this->session->set_flashdata('error', "Gagal menyimpan foto profil!");

            redirect('student/create');

            return;
        }

        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];

        $faculty_id = (int) $this->Major_model->select($this->input->post('major_id'))->faculty_id;

        $data = [
            'student_identification_number' => $this->input->post('student_identification_number'),
            'admission_track_id' => $this->input->post('admission_track_id'),
            'faculty_id' => $faculty_id,
            'major_id' => $this->input->post('major_id'),
            'location' => $this->input->post('location'),
            'class' => $this->input->post('class'),
            'profile_photo' => $file_name,
            'name' => $this->input->post('name'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'religion' => $this->input->post('religion'),
            'gender' => $this->input->post('gender'),
        ];

        $result = $this->Student_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan data mahasiswa!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data mahasiswa!');
        }

        redirect('student/create');
    }

    public function edit($id) {
        $row = $this->Student_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan!');

            redirect('student');

            return;
        }
        
        $header['page'] = 'Sunting Data Mahasiswa';
        $data['input_id'] = $id;
        $data['input_student_identification_number'] = $row->student_identification_number;
        $data['input_admission_track_id'] = $row->admission_track_id;
        $data['input_major_id'] = $row->major_id;
        $data['input_location'] = $row->location;
        $data['input_class'] = $row->class;
        $data['input_name'] = $row->name;
        $data['input_place_of_birth'] = $row->place_of_birth;
        $data['input_date_of_birth'] = $row->date_of_birth;
        $data['input_religion'] = $row->religion;
        $data['input_gender'] = $row->gender;
        $data['admission_tracks'] = $this->Admission_track_model->selectAll();
        $data['majors'] = $this->Major_model->selectAll();

        $this->load->view('header/header',$header);
        $this->load->view('students/edit', $data);
        $this->load->view('footer/footer');
    }

    public function update() {
        $id = $this->input->post('id');

        $row = $this->Student_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan!');

            redirect('student');

            return;
        }

        $this->form_validation->set_rules('student_identification_number', 'Student Identification Number', 'required|max_length[8]|callback_custom_unique[students.student_identification_number.'.$id.']');
        $this->form_validation->set_rules('admission_track_id', 'Admission Track ID', 'required|is_numeric');
        $this->form_validation->set_rules('major_id', 'Major ID', 'required|is_numeric');
        $this->form_validation->set_rules('location', 'Location', 'required|max_length[100]');
        $this->form_validation->set_rules('class', 'Class', 'required|max_length[5]');
        $this->form_validation->set_rules('profile_photo', 'Profile Photo', 'callback_validate_profile_photo_2');
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
        $this->form_validation->set_rules('place_of_birth', 'Place of Birth', 'required|max_length[100]');
        $this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
        $this->form_validation->set_rules('religion', 'Religion', 'required|max_length[50]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[50]');

        if ($this->form_validation->run() === FALSE) {
            $header['page'] = 'Tambah Data Mahasiswa';
            $data['input_id'] = $id;
            $data['input_student_identification_number'] = $this->input->post('student_identification_number');
            $data['input_admission_track_id'] = $this->input->post('admission_track_id');
            $data['input_major_id'] = $this->input->post('major_id');
            $data['input_location'] = $this->input->post('location');
            $data['input_class'] = $this->input->post('class');
            $data['input_name'] = $this->input->post('name');
            $data['input_place_of_birth'] = $this->input->post('place_of_birth');
            $data['input_date_of_birth'] = $this->input->post('date_of_birth');
            $data['input_religion'] = $this->input->post('religion');
            $data['input_gender'] = $this->input->post('gender');
            $data['admission_tracks'] = $this->Admission_track_model->selectAll();
            $data['majors'] = $this->Major_model->selectAll();

            $this->load->view('header/header', $header);
            $this->load->view('students/edit',$data);
            $this->load->view('footer/footer');

            return;
        }

        $faculty_id = (int) $this->Major_model->select($this->input->post('major_id'))->faculty_id;

        $data = [
            'student_identification_number' => $this->input->post('student_identification_number'),
            'admission_track_id' => $this->input->post('admission_track_id'),
            'faculty_id' => $faculty_id,
            'major_id' => $this->input->post('major_id'),
            'location' => $this->input->post('location'),
            'class' => $this->input->post('class'),
            'name' => $this->input->post('name'),
            'place_of_birth' => $this->input->post('place_of_birth'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'religion' => $this->input->post('religion'),
            'gender' => $this->input->post('gender'),
        ];

        if (!empty($_FILES['profile_photo']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 5120;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_photo')) {
                $this->session->set_flashdata('error', "Gagal menyimpan foto profil!");

                redirect('student/edit/' . $id);

                return;
            }

            $file_path = './uploads/' . $row->profile_photo;
            if (!empty($row->profile_photo) && file_exists($file_path)) {
                unlink($file_path);
            }
            
            $upload_data = $this->upload->data();
            $data['profile_photo'] = $upload_data['file_name'];
        }

        $result = $this->Student_model->update($id, $data);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menyunting data mahasiswa!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyunting data mahasiswa!');
        }

        redirect('student/edit/' . $id);
    }

    public function delete() {
        $id = $this->input->post('id');

        $row = $this->Student_model->select($id);
        if (!$row) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan!');

            redirect('student');

            return;
        }

        $file_path = './uploads/' . $row->profile_photo;
        if (!empty($row->profile_photo) && file_exists($file_path)) {
            unlink($file_path);
        }

        $result = $this->Student_model->delete($id);
        if ($result) {
            $this->session->set_flashdata('success', 'Berhasil menghapus data mahasiswa!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data mahasiswa!');
        }
        
        redirect('student');
    }

    public function validate_profile_photo()
    {
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/jpeg', 'image/png'];
            $max_size = 5 * 1024 * 1024;

            $file_type = mime_content_type($_FILES['profile_photo']['tmp_name']);
            $file_size = $_FILES['profile_photo']['size'];

            if (!in_array($file_type, $allowed_types)) {
                $this->form_validation->set_message('validate_profile_photo', 'Only JPG, JPEG and PNG files are allowed.');

                return FALSE;
            }

            if ($file_size > $max_size) {
                $this->form_validation->set_message('validate_profile_photo', 'File must be under 5MB.');

                return FALSE;
            }

            return TRUE;
        } else {
            $this->form_validation->set_message('validate_profile_photo', 'The %s field is required.');

            return FALSE;
        }
    }

    public function validate_profile_photo_2()
    {
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/jpeg', 'image/png'];
            $max_size = 5 * 1024 * 1024;

            $file_type = mime_content_type($_FILES['profile_photo']['tmp_name']);
            $file_size = $_FILES['profile_photo']['size'];

            if (!in_array($file_type, $allowed_types)) {
                $this->form_validation->set_message('validate_profile_photo', 'Only JPG, JPEG and PNG files are allowed.');

                return FALSE;
            }

            if ($file_size > $max_size) {
                $this->form_validation->set_message('validate_profile_photo', 'File must be under 5MB.');

                return FALSE;
            }

            return TRUE;
        } else {
            return TRUE;
        }
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
