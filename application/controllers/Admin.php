<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Admission_track_model');
        $this->load->model('Faculty_model');
        $this->load->model('Major_model');
        $this->load->model('Student_model');
    }

	public function index() {
		$header['page'] = "Dashboard Admin";
		$data['admission_tracks'] = $this->Admission_track_model->selectAll();
		$data['faculties'] = $this->Faculty_model->selectAll();
		$data['majors'] = $this->Major_model->selectAll();
		$data['students'] = $this->Student_model->selectAll();

		$this->load->view('header/header',$header);
		$this->load->view('dashboard', $data);
		$this->load->view('footer/footer');
	}
	
	public function login() {
		$this->load->view('login');
	}
}
