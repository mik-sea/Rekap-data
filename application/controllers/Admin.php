<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Admission_track_model');
        $this->load->model('Faculty_model');
        $this->load->model('Major_model');
    }

	public function index() {
		$data['page'] = "Dashboard Admin";
		$model['admission_tracks'] = $this->Admission_track_model->selectAll();
		$model['faculties'] = $this->Faculty_model->selectAll();
		$model['majors'] = $this->Major_model->selectAll();

		$this->load->view('header/header',$data);
		$this->load->view('dashboard', $model);
		$this->load->view('footer/footer');
	}
	
	public function login() {
		$this->load->view('login');
	}
}
