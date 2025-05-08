<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function index() {
		$data['page'] = "Dashboard Admin";
		$this->load->view('header/header',$data);
		$this->load->view('dashboard');
		$this->load->view('footer/footer');
	}
	
	public function login() {
		$this->load->view('login');
	}
}
