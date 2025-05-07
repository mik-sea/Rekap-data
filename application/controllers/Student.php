<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index(){
        $data['page'] = "Student";
        $model['students'] = $this->Student_model->getStudents();
		$this->load->view('header/header',$data);
		$this->load->view('students/index',$model);
		$this->load->view('footer/footer');
    }
}
